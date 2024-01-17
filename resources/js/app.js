import * as Turbo            from '@hotwired/turbo';
import {Application}         from '@hotwired/stimulus';
import {registerControllers} from 'stimulus-vite-helpers';
import TextareaAutogrow      from 'stimulus-textarea-autogrow'
import 'bootstrap';

window.Turbo = Turbo;

const application = (window.application = Application.start());
const controllers = import.meta.globEager('./**/*_controller.js')
registerControllers(application, controllers)
import './initializers/service-worker';

application.register('textarea-autogrow', TextareaAutogrow)
