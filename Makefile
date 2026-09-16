.PHONY: main build-image build-container start test shell stop clean

CONTAINER = string-calculator-kata

main: build-image build-container

build-image:
	docker build -t $(CONTAINER) .

build-container:
	docker run -dt --name $(CONTAINER) -v .:/540/StringCalculator $(CONTAINER)
	docker exec $(CONTAINER) composer install

start:
	docker start $(CONTAINER)

test: start
	docker exec $(CONTAINER) ./vendor/bin/phpunit $(if $(target),tests/$(target),)

shell: start
	docker exec -it $(CONTAINER) /bin/bash

stop:
	docker stop $(CONTAINER)

clean: stop
	docker rm $(CONTAINER)
	rm -rf vendor
