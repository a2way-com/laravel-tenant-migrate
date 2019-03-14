# Contributing

## Bug Reports and Feature Requests

These should be made by creating issues in [https://github.com/a2way-com/laravel-tenant-migrate/issues](https://github.com/a2way-com/laravel-tenant-migrate/issues).

Prepend following strings to the issue titles based on the nature of the issue.

- Bug Reports: `[Bug]`
- Feature Requests: `[Feature]`

## Branching

`master` branch is the main branch of the repository. It must only have released code. Every commit in the `master` branch must correspond to a release.

`dev` branch is the branch where the new features accumulate. Once enough features get accumulated in `dev` branch, it must be merged to the `master` branch, with a merge commit, resulting a release.

### Bug Fix Branches

If the bug exists in `master`, the bug fix branch must start off of the `master` branch, and merged into both `master` and `dev` branches.

If there are any release specific branches (Eg: `releases/x.y`.), and the bug is found on an earlier release branch like that, the bug fix branch must start off of the earliest release branch that has the bug, and merged into all subsequent release branches (If any.), `master`, and `dev`.

When merging bug fix branches in, that must always result in a merge commit. If merged into `master` or a release branch, that merge commit's message should be the version that that commit results in. If merged into `dev`, Git's automatic merge commit message should be left intact.

### Feature Branches

Feature branches must always start off of `dev` branch, and only be merged into `dev` branch itself, leaving no merge commit.

## Commit Messages

> Commit Often, Push Often, Perfect Later, Merge Once.

While you are working on your own branch, do commit often and feel free to put in any kind of commit message. Push these commits as soon as you make them.

## Sending in Merge Requests (a.k.a. Pull Requests)

When you're confident that your branch is ready to be merged in, you must squash all your working commits into a single nice presentable commit.

### Final Commit Message

For feature branches, the commit message should start with the issue ID, for which the branch is created for; it should be prefixed with hash symbol. The message should be English language, and [_Imperative Mood_](https://en.wikipedia.org/wiki/Imperative_mood).

>Eg: #149 Open the wormhole of the Monolith.

Here, "149" is the issue ID, and "Open the wormhole of the Monolith." is the message, which is in _Imperative Mood_. The message could be the title of the issue. It can be a better message as well.

For bug fix branches, start with the issue ID as above, and then write a short bug report the word "Fix:".

>Eg: #150 Fix: Hal 9000 is not opening the pod bay door.

"Hal 9000 is not opening the pod bay door." could have been the title of the bug report. It can be a better message as well.

Treat commit messages as a proper sentences; use proper punctuation marks, including periods at the end of the sentences.

### Creating the Merge Request

Be sure to set the appropriate target branch as described in the [Branching](#branching) section.

### Work In Progress Merge Requests

If you would like to get the community involved in a branch you're working, feel free to create Merge Requests with `[WIP]` prefixed to its title. You don't have to perfect your commits when creating a WIP Merge Request, but do point it at the correct target branch.
