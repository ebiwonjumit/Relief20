#!/bin/bash

git add .
read -p 'Commit Message: ' commitMessage
git commit -m  "$commitMessage"
echo -e "\n\n\n..............................................................."
echo -e "Pushing to Git\n"
git push  origin master
echo -e "\n\n\n..............................................................."
echo -e "Pushing to Heroku\n"
git push heroku master
