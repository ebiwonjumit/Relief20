#!/bin/bash

git add .
read -p 'Commit Message: ' commitMessage
git commit -m  "$commitMessage"
echo "Pushing to Git"
git push  origin master
echo "Pushing to Heroku"
git push heroku master
