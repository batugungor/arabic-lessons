import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [ "button", "selector" ]

    connect() {
        this.wordArray = [];
        this.form = this.selectorTarget.querySelector("form");
    }

    disconnect() {
        this.form.removeEventListener("submit", this.handleSubmit);
        this.buttonTarget.removeEventListener("click", this.handleClick);
    }

    handleSubmit(event) {
        event.preventDefault();

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "words";
        input.value = JSON.stringify(this.wordArray);

        this.form.appendChild(input);
        this.form.submit();
    }

    handleClick() {
        const selection = window.getSelection();

        if (selection.toString()) {
            const span = document.createElement("span");
            span.style.backgroundColor = this.getRandomColor();

            const selectedElement = selection.anchorNode.parentElement.closest("p");
            let innerHTML = selectedElement.getAttribute("data-dialogue-value");

            let startPos = innerHTML.indexOf(selection.toString());
            const endPos = startPos + selection.toString().length;

            if (startPos === -1) {
                startPos = 0;
            }

            selection.getRangeAt(0).surroundContents(span);
            this.wordArray.push({
                value: selection.toString(),
                start: startPos,
                end: endPos
            });
            this.clearSelection();
        }
    }

    getRandomColor() {
        const letters = "0123456789ABCDEF";
        let color = "#";
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    clearSelection() {
        if (window.getSelection) {
            window.getSelection().removeAllRanges();
        } else if (document.selection) {
            document.selection.empty();
        }
    }
}