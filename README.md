# Alec Rust Personal Portfolio/Blog [![Build Status](https://jenkins-alecrust.rhcloud.com/buildStatus/icon?job=production-build)](https://jenkins-alecrust.rhcloud.com/job/production-build/)

Deployed to [http://production-alecrust.rhcloud.com/](http://production-alecrust.rhcloud.com/), public site at [http://www.alecrust.com/](http://www.alecrust.com/). Uses WordPress theme `alec-rust`.

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

## Jenkins

There is a Jenkins application running at https://jenkins-alecrust.rhcloud.com/. When pushes to this GitHub repo are made Jenkins is notified via a webhook and initiates a build on the `production-build` Jenkins project:

https://jenkins-alecrust.rhcloud.com/job/production-build/

After changes have been deployed the CloudFlare cache for the `alecrust.com` domain is purged as part of the build script.

## NPM Scripts

There are a few handy NPM scripts for your convenience:

- `devon` - Switch CloudFlare's "Dev Mode" on for this domain
- `devoff` - Switch CloudFlare's "Dev Mode" off for this domain
- `deploy` - Push changes to OpenShift, triggering Jenkins build. Then runs `purgecache` below
- `purgecache` - Purge CloudFlare's entire cache for this domain
- `jenkins` - Run the [`jenkins_build.js`](misc/jenkins_build.js) deployment script

## Environment Variables

Here are some common OpenShift environment variables:

    getenv('OPENSHIFT_APP_NAME') - Application name
    getenv('OPENSHIFT_DATA_DIR') - For persistent storage (between pushes)
    getenv('OPENSHIFT_TMP_DIR')  - Temp storage (unmodified files deleted after 10 days)
