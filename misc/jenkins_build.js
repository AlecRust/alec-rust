var curl = require('curlrequest');

var jenkinsUrl = 'https://jenkins-alecrust.rhcloud.com/job/production-build/';

var options = {
    url: jenkinsUrl + 'build',
    method: 'POST',
    data: {
        token: process.env.BUILD_AUTH_TOKEN
    },
    user: process.env.BUILDER_USERNAME + ':' + process.env.BUILDER_API_TOKEN
};

curl.request(options, function () {
    console.log('Remote build request sent. Check at ' + jenkinsUrl);
});
