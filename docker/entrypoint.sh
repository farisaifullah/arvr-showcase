#!/bin/bash

# Jalankan Octane
exec php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=90 --admin-port=5050
