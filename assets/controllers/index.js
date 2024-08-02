import { Application } from '@hotwired/stimulus';
import { startStimulusApp } from '@symfony/stimulus-bridge';

const application = Application.start();
const context = require.context('./', true, /\.js$/);
application.load(startStimulusApp(context));