<?php

use Swoole\Coroutine\Http\Client;

$servidor = new Swoole\Http\Server('0.0.0.0', 9000);

$servidor->on('request', function ($request, $response) {
    $channel = new chan(2);

    go(function () use ($channel) { 
        $cliente = new Client('localhost', 9002);
        $cliente->get('/servidor.php');
       
        $conteudo = $cliente->getBody();        
        $channel->push($conteudo);
    });

    go(function () use ($channel) {
        $conteudoArquivo = file_get_contents('arquivo.txt');

        $channel->push($conteudoArquivo);
    });

    go(function () use ($channel, &$response) {
        $primeiroRetorno = $channel->pop();
        $segundoRetorno = $channel->pop();

        $response->end($primeiroRetorno . $segundoRetorno);
    });
});

$servidor->start();