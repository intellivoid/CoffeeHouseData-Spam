build:
	python3 -m coffeehouse_dltc --train-model chatrooms

background_build:
	screen -dm bash -c 'python3 -m coffeehouse_dltc --train-model chatrooms'

test:
	python3 -m coffeehouse_dltc --test-model chatrooms_build

clean:
	@for f in $(shell ls spam_ham/); do \
		echo "Processing $${f}" && sort -u "chatrooms/$${f}" > "chatrooms/$${f}.clean" && rm "chatrooms/$${f}" && mv "chatrooms/$${f}.clean" "chatrooms/$${f}"; \
	done