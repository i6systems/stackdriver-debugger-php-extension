/*
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

#ifndef PHP_STACKDRIVER_DEBUGGER_RANDOM_H
#define PHP_STACKDRIVER_DEBUGGER_RANDOM_H 1

#if PHP_VERSION_ID < 70100
#include "standard/php_rand.h"
#else
#include "standard/php_mt_rand.h"
#endif
#include "standard/php_math.h"

static zend_string *generate_breakpoint_id()
{
#if PHP_VERSION_ID < 80000
    zval zv;
    ZVAL_LONG(&zv, ((uint32_t) php_mt_rand()) >> 1);
    return _php_math_longtobase(&zv, 16);
#else
    zend_long random_int = ((uint32_t) php_mt_rand()) >> 1;
    return _php_math_longtobase(random_int, 16);
#endif
}

#endif /* PHP_STACKDRIVER_DEBUGGER_RANDOM_H */
