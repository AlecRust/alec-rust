Alec Rust Personal Portfolio/Blog
=================================

`alec-rust` theme deployed to [http://alecrust-alecrust.rhcloud.com/](http://alecrust-alecrust.rhcloud.com/).

Repo layout
===========

- .openshift/pear.txt - list of pears to install
- .openshift/action_hooks/pre_build - Script that gets run every git push before the build
- .openshift/action_hooks/build - Script that gets run every git push as part of the build process (on the CI system if available)
- .openshift/action_hooks/deploy - Script that gets run every git push after build but before the app is restarted
- .openshift/action_hooks/post_deploy - Script that gets run every git push after the app is restarted
- gulp/ - Development tasks run by gulp
- libs/ - Additional libraries
- misc/ - For not-externally exposed php code
- php/ - Externally exposed php code goes here
- src/ - Source files of theme
- ../data - For persistent data (full path in environment var: OPENSHIFT_DATA_DIR)

Environment Variables
=====================

OpenShift provides several environment variables to reference for ease
of use.  The following list are some common variables but far from exhaustive:

    getenv('OPENSHIFT_APP_NAME')  - Application name
    getenv('OPENSHIFT_DATA_DIR')  - For persistent storage (between pushes)
    getenv('OPENSHIFT_TMP_DIR')   - Temp storage (unmodified files deleted after 10 days)
