const fs = require('fs');
const criticalCss = fs.readFileSync('critical.css', 'utf8');
const file = 'core/resources/views/master/front.blade.php';
let content = fs.readFileSync(file, 'utf8');

const target = `<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/plugins.min.css')}}">

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">`;

const replacement = `<style>
${criticalCss}
</style>
<link rel="stylesheet" media="print" onload="this.media='all'" href="{{asset('assets/front/css/plugins.min.css')}}">
<noscript><link rel="stylesheet" href="{{asset('assets/front/css/plugins.min.css')}}"></noscript>

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="print" onload="this.media='all'" href="{{asset('assets/front/css/styles.min.css')}}">
<noscript><link rel="stylesheet" href="{{asset('assets/front/css/styles.min.css')}}"></noscript>`;

if (content.includes(target)) {
    content = content.replace(target, replacement);
    fs.writeFileSync(file, content);
    console.log("Successfully injected critical CSS!");
} else {
    console.log("Could not find target content!");
}
