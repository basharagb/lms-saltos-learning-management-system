#!/bin/bash

# Modern LMS Server Startup Script
# This script starts the Laravel server with custom PHP configuration

echo "🚀 Starting Modern LMS Server..."
echo "📱 UI has been updated with modern design"
echo "🔧 PHP deprecation warnings are suppressed"
echo ""

# Check if PHP configuration file exists
if [ -f "php.ini" ]; then
    echo "✅ Using custom PHP configuration (php.ini)"
    echo "   - Deprecation warnings suppressed"
    echo "   - Modern PHP compatibility enabled"
    echo ""
fi

# Start the server with custom configuration
echo "🌐 Starting server on http://localhost:8000"
echo "📋 Demo credentials available in DEMO_CREDENTIALS.md"
echo ""

# Use custom PHP configuration if available
if [ -f "php.ini" ]; then
    php -c php.ini artisan serve --host=0.0.0.0 --port=8000
else
    php artisan serve --host=0.0.0.0 --port=8000
fi

