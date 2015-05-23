Alec Rust Personal Portfolio/Blog
=================================

Deployed to [http://alecrust-alecrust.rhcloud.com/](http://alecrust-alecrust.rhcloud.com/), public site at [http://www.alecrust.com/](http://www.alecrust.com/). Uses WordPress theme `alec-rust`.

## Repo layout

    .openshift/action_hooks/build       - Script that gets run every git push as part of the build process (on the CI system if available)
    .openshift/action_hooks/deploy      - Script that gets run every git push after build but before the app is restarted
    .openshift/action_hooks/post_deploy - Script that gets run every git push after the app is restarted
    .openshift/action_hooks/pre_build   - Script that gets run every git push before the build
    .openshift/themes/alec-rust         - Distribution folder for WordPress theme
    .openshift/pear.txt                 - List of pears to install
    gulp/                               - Development tasks run by gulp
    libs/                               - Additional libraries
    misc/                               - For not-externally exposed php code
    php/                                - Externally exposed php code goes here
    src/                                - Source files of WordPress theme
    ../data                             - For persistent data (full path in environment var: OPENSHIFT_DATA_DIR)

## Environment Variables

Here are some common OpenShift environment variables:

    getenv('OPENSHIFT_APP_NAME') - Application name
    getenv('OPENSHIFT_DATA_DIR') - For persistent storage (between pushes)
    getenv('OPENSHIFT_TMP_DIR')  - Temp storage (unmodified files deleted after 10 days)
