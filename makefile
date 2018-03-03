bigdata: arubasyslog.c hash_32a.c
	gcc -O3 -o arubasyslog arubasyslog.c hash_32a.c -lpthread
