# Build docker 
     docker build -t php-senter code herewoole .
  
# Execute container
    docker run -itv $(pwd):/app -w /app -p 9000:9000 php-swoole bash
