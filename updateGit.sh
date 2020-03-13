#!/bin/bash

git add .
read -p 'Commit Message: ' commitMessage

git commit -m $commitMessage

git push -u origin master
