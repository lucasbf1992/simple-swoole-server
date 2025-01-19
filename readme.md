docker build -t php-swoole . 

docker run -itv $(pwd):/app -w /app -p 9000:9000 php-swoole bash