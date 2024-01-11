# ZWA-semestral - Car Blog

# Programmer documentation

Blog website allow user to read and write articles on webpage.
Articles can be edit/delete by user who created it or by admin.

* Posts then can be displayed by category or by user who published it by clicking on category/user link from the post

There is 3 types of user on webpage - not logged in user, logged in user and admin

* Not logged in user - can only read and like the article
* Logged in user - can add an article on page, then edit/delete it 
* Admin - has all the functionality ad logged in user, they can further edit/delete other user's posts. Admin a
also the privelege to promote or demote user's role

## SiteMap

* index.php
    *  faq.php
    * about.php
    * category.php
    * article.php
        * editPost.php
    * login.php
    * signUp.php
    * profile.php
        * manageUser.php

## Technology

* HTML5 - structure content
* CSS3 - normal style, printing style
* Javascript - frontend validation, like functionality, pagination
* PHP - backend

## Classes ##

* `PostRepository` - operation with `Post` table, select and count `Post` from database
* `UserRepository` - operation with `User` table, select and count `User` from database
* `Pagination` - calculate page links from total links and links per page
* `Validation` - class that validate input from users



## Basic operation ##

**addPost**
1. Validation using `Validation` class
2. Make unique filename by concatenating `uniqid()` to filename.
3. Add post to database `addPost()`

**signUp**
1. Validation using `Validation` class
2. `findUserByUsername()`check if user's username exists in database
3. Hash password using `password_hash()`
4. `createUser()` add user to database

**login**
1. Validation using `Validation` class
2. `findUserByUsername()`check if user's username exists in database
3. `password_verify()`check if password match
4. set `$_SESSION['user]` variable

**editPost**
1. Validation using `Validation` class
2. delete file old file, then move new file to folder
3. Update post to database `updatePostById()`

**deletePost**
1. check if post belong user
2. select post from database `selectPostById()`
3. delete file from folder
4. delete post from database `deletePostById()`

**Update Role**
1. Find user in database using `findUserByUsername()`
1. Check if user's is logged in and role is admin
2. Update role for user using `updateRoleByUsername()`

**Update Role**
1. unset `$_SESSION['user]`
2. Redirect user to homepage and notificate user

## Other functionalities ##

* `Latest Post Pagination` - implemented using `fetch()` on `latestPostController`
* `Like button` - send request with post id to `likeController`, controller then increment like number in database and return current like number.

## File operation ##
* `move_upload_file()` - add file to folder
* `unlink()` - delete file from folder




# Product documentation

- Car blog is a forum website where people can share their knowledge about cars. Every user can read any posts about cars on the page. Posts are displayed by date added in `Latest posts` section. There are 3 posts with the mosts likes in `Trending posts` section. Posts can be further displayed by `category` or by their `author`. User can view other posts using pagination on the bottom of the page.

- If user want to add a post on page.They must `Sign Up` by entering unique `username`, `password` and ` confirm password`. Signed up user can then log in through `Log in` page by entering `username` and `password` they entered on sign up page. Logged in users can then write an article, further edit and delete it. Each user have a `Profile` page, where user can view their info (username, role, total post, total likes). Users can then logout by clicking on `logout` button on navigation bar.

- `Article` page is where user can view article in full form. Author can then edit/delete by clicking on `Edit`/`Delete` button.

- `Edit page` - is form where user gets their posts prefilled on the form. User can decide to add a new picture or keep the old one by letting the file input none.

- There are `Admin` on page. Admin has the privilege to edit and delete any post from any users. Admin can  also promote or demote other user's role by clicking `Manage users` button on their profile page.

- `FAQ` - On this page can user find mosts asked question about functionality of the web.

- `About` - On this page is a brief introduction to the page.

- `Topics` - Links to all categories on the page

## Page visual


### Homepage

* User can navigate through navigations bar on top of the page. On the right side of the navigation is `login` and `sign up` button if users is not logged in. When the user is logged in, there will be *username* and *role* displayed along with the `logout` button.

* `Write an article` button under the welcome text redirect user to `addPost` page if the user is logged in, otherwise user will be redirect to `login` page with error notification.

![homepage-visual](https://i.imgur.com/zGdn7Cd.png)


### Pagination and posts displaying

* Latests posts section is a place, where users can see their added post as first post. Clicking on number of the pagination page will display other 6 posts ordered by date added.

![pagination-visual](https://i.imgur.com/kf5LuJP.png)


### Display posts by category

* This page display 5 posts by category and ordered by date added.

![posts-by-cat-visual](https://i.imgur.com/KQv1xp6.png)

### Single post display

* This page display single post in full view. Author can find edit and delete button

![single-post-visual](https://i.imgur.com/LhMoHVf.png)

### Display user's posts and user's info

* Profile page where logged in user can find their info and their added posts.

![user-profile-visual](https://i.imgur.com/gSo1Yi3.png)


### Manage users of admin page

* Manage user page is available only for user with admin role, where admin can promote/demote every user.

![user-profile-visual](https://i.imgur.com/1vYsTdh.png)

### Login form 

* Login form with username and password field. Required field are then colorized with red color

![login-form-visual](https://i.imgur.com/1HeisZd.png)

### Sign Up form

![sign-up-form-visual](https://i.imgur.com/8Can8NH.png)

* Sign up form with username, password and confirm password. Username must be unique. Password and confirm password must be matched.

### Add posts form

![add-post-visual](https://i.imgur.com/5nch1R0.png)

* User must fill every field. File type must be jpg, jpeg or png and size must be less than 2MB. Article body must be more than 10 word.

### Edit form 

![edit-form-visual](https://i.imgur.com/zPTZhS0.png)


* Edit form will be filled with current data from article. User can choose to edit any field. File input can be empty if user don't want to change article's image.











