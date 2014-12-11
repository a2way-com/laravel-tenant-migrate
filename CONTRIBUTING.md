#A2Way Laravel Tenant Migrate Contribution Guide

##Branching and Merging Model

###Branching

####Features and Improvements

 - Create new feature (Includes improvements.) branches from the current DEV branch.
 - If you are working as per a submitted feature request, name the brnach as "do#XX"[^XX].

####Bug Fixes
 - Create new bug fix branches from the current MASTER branch.
 - If you are working as per a submitted bug report, name the brnach as "fix#XX"[^XX].

###Merging

 - Once finished (Includes making sure it's working as expected.), squash all the commits in your branch into one commit. This final commit's message should be "#XX[^XX] Does this". The message should be imperative.
 - Once squashed, rebase it on to the current status of the branch, from which you originated yours (DEV for features and improvements, and MASTER for bug fixes.). Then submit the Merge Request (Pull Request) for your branch to be merged into it's parent branch.

[^XX]: "XX" is the ID of the issue.