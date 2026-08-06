import { generate } from 'critical';

generate({
    base: 'source_code/core/public/',
    src: 'https://ms-bd.com',
    target: 'assets/front/css/critical.css',
    dimensions: [
        {
            height: 896,
            width: 414,
        },
        {
            height: 1080,
            width: 1920,
        },
    ],
    extract: false,
}).then(() => {
    console.log('Critical CSS generated successfully');
}).catch((err) => {
    console.error('Error generating critical CSS:', err);
});
