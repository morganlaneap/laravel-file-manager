## LaravelFileManager
LaravelFileManager is a simple web file manager written in Laravel with AngularJS.
It allows you to keep track of and manage files in the cloud. Comes with a user system,
permissions and a quote/size tracker so you can limit how much people can upload.

### Current Features
- Multiple file uploading.
- Folder management system.
- Ability to download uploaded files.
- Ability to rename existing files and folders.
- Ability to sort by Name, Size or Date Modified.
- Basic admin section for modifying settings (and users soon).

### Updates
I'm working on this in my spare time, so it'll be updated as and when. Feel free to contribute and add things you think would make it awesome.

I have a lot of features planned for the future.

### Installation
1) Clone the repo.
2) Run `composer update`
3) Set your database in `.env` (if it doesn't exist, create a copy from `env.example`)
4) Run `php artisan migrate` to update your database.
5) Run `php artisan db:seed` to insert the default values required.
6) Navigate to *http://your_host/public/register* and create an account.
7) Configure the application to your needs.
8) You're good to go.

### FAQ
**Q1) Can I use this for cloud file hosting?**

A1) Yes. When LaravelFileManager is a little more advanced, it will be suitable 
 for running cloud file hosting.
 
**Q2) Where are files stored?**

A2) By default, files are stored in `/storage/app/uploads`, but I plan an ability to change this.

**Q3) How do I contribute?**

A3) See [here](https://help.github.com/articles/about-pull-requests/) for how to get started. I'm open to
others joining the collaborator list :)

### Credits
Here's a list of the other projects I've used in this:

- [angular-file-upload](https://github.com/nervgh/angular-file-upload)
- [toastrjs](https://github.com/CodeSeven/toastr)
- [angular drag and drop code](https://codepen.io/thgreasi/pen/zKWYWR)