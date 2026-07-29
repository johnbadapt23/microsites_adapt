export default {
    build: {
        base: 'assets/',
        scripts: 'assets/js/',
        styles: 'assets/css/',
        images: 'assets/images/',
        fonts: 'assets/fonts/',
        favicons: 'assets/icons/'
    },
    src: {
        html: '**/*.html',
        php: '**/*.php',
        // NOTE: jQuery is bundled first so it's available as a global before
        // every other plugin below (all of which expect $ / jQuery on window).
        // It used to load from an unpinned CDN (jquery 2.1.4) in header.php;
        // it's now self-hosted here via npm so it's versioned, current, and
        // doesn't depend on an external CDN being up.
        scripts: [
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/select2/dist/js/select2.js',
            'node_modules/magnific-popup/dist/jquery.magnific-popup.js',
            'node_modules/slick-carousel/slick/slick.min.js',
            'node_modules/jquery.scrollto/jquery.scrollTo.min.js',
            'node_modules/jquery.localscroll/jquery.localScroll.min.js',
            'node_modules/js-cookie/dist/js.cookie.min.js',
            'node_modules/jquery.scrollbar/jquery.scrollbar.min.js',
            'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
            'node_modules/jquery-match-height/dist/jquery.matchHeight-min.js',
            'source/js/main.js',
        ],
        styles: [
            // 'node_modules/aos/dist/aos.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/select2/dist/css/select2.css',
            'node_modules/perfect-scrollbar/css/perfect-scrollbar.css',
            'node_modules/jquery.scrollbar/jquery.scrollbar.css',
            'node_modules/slick-carousel/slick/slick.css',
            'node_modules/slick-carousel/slick/slick-theme.css',
            'node_modules/hover.css/css/hover-min.css',
            'source/scss/main.scss',
        ],
        images: [
            'source/images/**/*.jpg',
            'source/images/**/*.gif',
            'source/images/**/*.svg',
            'source/images/**/*.png'
        ],
        fonts: 'source/fonts/*.{ttf,otf}',
        icons: 'source/icons/*.svg',
        favicon: {
            master: 'source/images/favicon.png',
            path: '/assets/icons/',
            data: 'faviconData.json',
            html: 'templates/partials/_icons.php',
            design: {
    			ios: {
    				pictureAspect: 'backgroundAndMargin', // backgroundAndMargin, noChange
    				backgroundColor: '#ffffff',
    				margin: '21%'
    			},
    			desktopBrowser: {},
    			windows: {
    				pictureAspect: 'whiteSilhouette', // noChange, whiteSilhouette
    				backgroundColor: '#b69e58',
    				onConflict: 'override'
    			},
    			androidChrome: {
    				pictureAspect: 'backgroundAndMargin', // noChange, backgroundAndMargin, shadow
    				margin: '17%',
    				backgroundColor: '#ffffff',
    				themeColor: '#ffffff',
    				manifest: {
    					name: 'Orchards',
    					display: 'browser', // browser, standalone
    					orientation: 'notSet',
    					onConflict: 'override'
    				}
    			},
    			safariPinnedTab: {
    				pictureAspect: 'silhouette', // noChange, silhouette, blackAndWhite
    				themeColor: '#000000'
    			}
    		},
            settings: {
    			compression: 5, // 0-5
    			scalingAlgorithm: 'Lanczos', // Mitchell, NearestNeighbor, Cubic, Bilinear, Lanczos, Spline
    			errorOnImageTooSmall: false
    		}
        }
    },
    watch: {
        html: '**/*.html',
        php: '**/*.php',
        scripts: 'source/js/**/*.js',
        style: 'source/scss/**/*.scss',
        images: 'source/images/**/*.*',
        fonts: 'source/fonts/**/*.ttf',
        icons: 'source/icons/*.svg',
        favicon: 'source/images/favicon.png'
    },
    deploy: {
        files: '**/*',
        folder: './',
        archive: 'CARERSNT.zip',
        repository: 'https://github.com/shop12dev/carersnt.git'
    }
};

