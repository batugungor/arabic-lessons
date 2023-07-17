// assets/controllers/say-hello-controller.js
import {Controller} from '@hotwired/stimulus';
import axios from 'axios';

export default class extends Controller {
    static targets = ['name', 'output', 'chapter']
    static values = {
        url: String
    }

    async initialize() {
        this.chapterTarget.innerHTML = await axios.get(this.urlValue)
            .then(result => {
                return result.data;
            })
            .catch(error => {
                return Promise.reject(error);
            });
    }
}