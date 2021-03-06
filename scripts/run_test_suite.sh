#!/usr/bin/env bash
# Copyright 2017 Google Inc.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

# A script for installing necessary software on CI systems.

set -ex

if [ -z "${APPENGINE_PROJECT_ID}" ]; then
    APPENGINE_PROJECT_ID="google-appengine"
fi

gcloud builds submit \
    --config=cloudbuild.yaml \
    --substitutions=_APPENGINE_PROJECT_ID=$APPENGINE_PROJECT_ID,_GOOGLE_PROJECT_ID=$GOOGLE_PROJECT_ID,_GOOGLE_CREDENTIALS_BASE64=$GOOGLE_CREDENTIALS_BASE64,_PHP_DOCKER_GOOGLE_CREDENTIALS=$PHP_DOCKER_GOOGLE_CREDENTIALS,_CLOUDSDK_ACTIVE_CONFIG_NAME=$CLOUDSDK_ACTIVE_CONFIG_NAME \
    .
