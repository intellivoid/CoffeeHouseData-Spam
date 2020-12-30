build_chatrooms:
	python3 -m coffeehouse_dltc --train-model chatrooms

build_email_contents:
	python3 -m coffeehouse_dltc --train-model email_contents

build_email_subjects:
	python3 -m coffeehouse_dltc --train-model email_subjects

build:
	make build_chatrooms
	make build_email_contents
	make build_email_subjects

test_chatrooms:
	python3 -m coffeehouse_dltc --test-model chatrooms_build

test_email_contents:
	python3 -m coffeehouse_dltc --test-model email_contents_build

test_email_subjects:
	python3 -m coffeehouse_dltc --test-model email_subjects_build

clean:
	@for f in $(shell ls chatrooms/); do \
		echo "Processing $${f}" && sort -u "chatrooms/$${f}" > "chatrooms/$${f}.clean" && rm "chatrooms/$${f}" && mv "chatrooms/$${f}.clean" "chatrooms/$${f}"; \
	done
	@for f in $(shell ls email_contents/); do \
		echo "Processing $${f}" && sort -u "email_contents/$${f}" > "email_contents/$${f}.clean" && rm "email_contents/$${f}" && mv "email_contents/$${f}.clean" "email_contents/$${f}"; \
	done
	@for f in $(shell ls email_subjects/); do \
		echo "Processing $${f}" && sort -u "email_subjects/$${f}" > "email_subjects/$${f}.clean" && rm "email_subjects/$${f}" && mv "email_subjects/$${f}.clean" "email_subjects/$${f}"; \
	done