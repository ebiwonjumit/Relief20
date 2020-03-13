#!/bin/bash

git add .
read -p 'Commit Message: ' commitMessage
git commit -m  "$commitMessage"
echo "\n\n\n..............................................................."
echo "Pushing to Git\n"
git push  origin master
echo "\n\n\n..............................................................."
echo "Pushing to Heroku\n"
git push heroku master
