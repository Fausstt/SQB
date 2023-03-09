/* eslint-disable */
const CrmWidgetsConfigModule = angular.module('prf.widgets.config', []);
const EnvConfig = {
    api: `https://api.${domain.url}/`,
    streamer: `https://streamer.${domain.url}/`,
    requestCache: 'true',
};
CrmWidgetsConfigModule.constant('prfEnvConfig', EnvConfig);
