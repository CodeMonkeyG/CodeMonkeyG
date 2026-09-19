#!/bin/sh
set -e

# If node_modules is missing or empty (e.g. initial mount), install dependencies
if [ ! -d "node_modules" ] || [ -z "$(ls -A node_modules 2>/dev/null)" ]; then
  echo "Installing dependencies..."
  npm install
fi

if [ "$NODE_ENV" = "production" ]; then
  echo "Building Astro blog for production..."
  npm run build
  echo "Starting Astro production preview server on 0.0.0.0:4321..."
  exec npm run preview -- --host 0.0.0.0 --port 4321
else
  echo "Starting Astro development server with HMR on 0.0.0.0:4321..."
  exec npm run dev -- --host 0.0.0.0 --port 4321
fi
