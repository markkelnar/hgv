# Contributing to HGV #

Contributions to the HGV project are more than welcome.

## License ##

By contributing code to the [HGV project](https://github.com/wpengine/hgv), you agree to license your contribution under the GPL V2 license. Further, with respect to any copyrights in your contribution: 1. you hereby assign to us joint ownership, and to the extent such assignment is invalid, ineffective or unenforceable, you hereby grant to us a perpetual, fully-sublicensable, irrevocable, non-exclusive, worldwide, no-charge, royalty-free, unrestricted license to exercise all rights under those copyrights; 2. that each of us can act as if we are the sole owner of such copyright, and if one of us makes a derivative work of your contribution, the one who makes the derivative work will be the sole owner; and, 3. we agree that each party may register a copyright in your contribution and exercise all ownership rights associated with it. The rights that you grant us are effective on the date you first submit a contribution. 

## Issues ##

Open a GitHub issue for anything. Don't worry if you find yourself opening something that sounds like it could be obvious. Someone else might have the same question.

## Comments ##

Comment on any GitHub issue, open or closed. The only guidelines here are to be friendly and welcoming. If you see that a question has been asked and you think you know the answer, feel free to respond. No need to wait!

## Code Submission ##

### Work Flow ###

The **master** branch is the latest stable release.  The **develop** branch is where new features and on-going development take place.  The next stable release will come from the **develop** branch.

### Pull Requests ###

Submit a pull request at any time, whether an issue has been created or not. It may be helpful to discuss your goals in an issue first, though many things can best be shown with code.

We do ask that the pull request be submitted against the **develop** branch from a feature branch in your fork of the project in GitHub. We ask that you test your code as we will also do our best to code review, test and verify that the pull request is as stable as possible before merging it.

We also encourage you to pull down code you see in someone else's pull request, test it and provide your findings in a comment, that's always fun and helpful to the community project.

After reviewing the PR, and a blessing from the reviewer, the PR is considered approved and able to be merged.

### Hotfixes ###

If a bug fix or code change is deemed important enough that it should be fixed in the latest stable release, the pull request should be targeted at the **master** branch. with the same markdown checkboxes provided above.

Once reviewed and tested, it will be merged and a new 'patch' release will be created following the instructions below.

After a release is created, any changes introduced into **master** that bypassed the **develop** branch, should be merged into the **develop** branch.  This can be done in GitHub as a pull request.

## Code Style ##

### Ansible ###

The vast majority of HGV is written in and powered by Ansible. We are developing an Ansible scripting standard.

### Bash Scripting ###

For any shell scripting that we do in Bash — see `bin/hgv-init.sh` — we try to follow the style provided in Google's [Shell Style Guide](http://google-styleguide.googlecode.com/svn/trunk/shell.xml).

### PHP ###

For any PHP, we try to follow the WordPress core [code standards](http://make.wordpress.org/core/handbook/coding-standards/).

### Releases ###
1. Create the change log history.  Checkout the 'master' branch and run the following command:

    git log --no-merges --format=" * %ad %an: %s" v1.0..HEAD --date=short | sort -ur

2. Prepend the output in the CHANGELOG.md file.  
3. Update the version number and latest stable version in README.md.
4. Push those changes as a pull request to github. Then merge into master when ready.
5. Draft an new [release](https://github.com/wpengine/hgv/releases).
