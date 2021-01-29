import React from 'react';
import { render } from 'react-dom';
import { InertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress'
import * as Sentry from '@sentry/browser';

Sentry.init({
    dsn: process.env.MIX_SENTRY_LARAVEL_DSN
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})

const app = document.getElementById('app');

render(
    <InertiaApp
        initialPage={JSON.parse(app.dataset.page)}
        resolveComponent={name =>
            import(`./Pages/${name}`).then(module => module.default)
        }
    />,
    app
);
