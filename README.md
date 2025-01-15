# Library Management System
### Features Overview

#### 1. **Authentication**

- **Google Authentication**: Users can log in using their Google account.
- **Login, Logout, Register**: Standard email and password-based login, logout, and registration functionalities are provided.

#### 2. **Books**

- **Search Books**: Users can search books by keyword.
- **Filter Books**: Users can filter books by genre or language.
- **Sorting**: Users can sort books by popularity, number of reviews, etc.

#### 3. **Members**

- **Login & Register**: Members can create an account and log in.
- **Book Loans History**: Members can view their book loans history and sort them by loan date, return date, or status.
- **Profile Management**: Members can update or delete their profile.
- **Reviews**: Members can add, edit, or delete book reviews.
- **Notifications**: Members will receive notifications about overdue fees.
- **Favorites**: Members can add books to their favorites list. They can also view or remove books from their favorites list.

#### 4. **Librarians**

- **Login & Register**: Librarians can create an account and log in.
- **Book Loans Management**: Librarians can:
  - View all book loans.
  - Update existing book loans.
  - Create new book loans.
  - Search loans by borrow/return date or status.
- **Member Management**: Librarians can:
  - Update or delete member profiles.
  - Search members by first name, last name, or email.
  - View individual members' book loans.
- **Overdue Fees**: Librarians can delete overdue fees.
- **Favorites**: Librarians can add books to their favorites list. They can also view or remove books from their favorites list.

#### 5. **Admins**

- **Settings Management**:
  - Set the overdue fees amount.
  - Define the maximum number of books a user can borrow.
  - Set the loan duration (in days).
- **Role Assignment**: Admins can assign roles (member, librarian, or admin) to users.
- **Overdue Fees Management**: Admins can **delete overdue fees**.  
  - Route: `DELETE /notifications/{notification}`
- **Favorites**: Admins can add books to their favorites list. They can also view or remove books from their favorites list.

---

### Features and Role-Based Access

#### **1. Authentication**
- **Login & Register**: All users (members, librarians, and admins) can register and log in with email/password or Google authentication.
  - Guest users can access the login and registration routes.

#### **2. Books**
- **View Books**: Everyone can **view** the list of books and their details.  
  - Route: `GET /books`, `GET /books/{book}` (accessible by everyone)
  
- **Manage Books**: Only **librarians** and **admins** can **create, edit, or delete books**.  
  - Route: `POST /books`, `PUT /books/{book}`, `DELETE /books/{book}` (accessible by librarians and admins)

- **Search & Filter Books**: All users can search for books and filter by genre or language.
  
- **Sorting**

#### **3. Members**
- **Login & Register**: Members can create an account and log in.  
  - Routes: `/auth/login`, `/auth/register` (accessible by guests)
  
- **Book Loans History**: Members can view and sort their book loans. 
  - Route: `GET /users/{user}/book_loans` (only accessible by the member themselves or admins/librarians)
  
- **Manage Profile**: Members can update their profile details and delete their account.  
  - Routes: `GET /users/{user}/edit`, `PUT /users/{user}`, `DELETE /users/{user}` (only accessible by the member themselves or admins/librarians)
  
- **Add/Edit/Delete Reviews**: **Only members** can add, edit, or delete reviews for books they've borrowed.  
  - Routes: `/reviews` (create), `PUT /reviews/{review}`, `DELETE /reviews/{review}` (only accessible by the member who created the review)

- **Notifications**: Members will receive **personal notifications** including overdue fees.  
  - Route: `GET /notifications` (accessible by the member themselves)
  
- **Favorites**: All users (members, librarians, and admins) can add books to their favorite list.  
  - Route: `POST /favorites/{book}` (accessible by everyone)

#### **4. Librarians**
- **Manage Users**: Librarians can view the list of users, their profiles, and manage book loans.  
  - Route: `GET /users`, `GET /users/{user}/book_loans` (view user data and loans)
  
- **Book Loans Management**: Librarians can create, update, or view book loans.  
  - Routes: `/book_loans`, `PUT /book_loans/{loan}`, `POST /book_loans` (accessible by librarians and admins)

- **Overdue Fees Management**: Librarians can **delete overdue fees** for members.  
  - Route: `DELETE /notifications/{notification}`
  
- **Favorites**: Librarians can add books to their favorite list. They can also view or remove books from their favorites list.

- **Cannot Add/Edit/Delete Reviews**: Librarians **cannot** manage reviews. Reviews can only be managed by the member who created them.

#### **5. Admins**
- **Settings Management**: Only **admins** can access and modify application-wide settings like overdue fees, max books allowed, and loan durations.  
  - Routes: `/settings` (accessible only by admins)

- **Role Management**: Admins can assign roles (member, librarian, admin) to users.  

- **Overdue Fees Management**: Admins can **delete overdue fees** for members, but cannot view or modify personal notifications.  
  - Route: `DELETE /notifications/{notification}`

- **Favorites**: Admins can add books to their favorite list. They can also view or remove books from their favorites list.

  ---
### Installation Steps

1. **Install Composer Dependencies**

   ```bash
   composer install
   ```

2. **Install NPM Dependencies**

   ```bash
   npm install
   ```

3. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

4. **Create and Configure Database**

   - Create a new database in your preferred SQL management tool.
   - Update the `.env` file with your database credentials:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

5. **Run Migrations and Seed Data**

   ```bash
   php artisan migrate:refresh --seed
   ```

6. **Start the Development Server**

   ```bash
   php artisan serve
   ```

7. **Building Tailwind CSS and Alpine.js**

   ```bash
   npm run dev
   ```

---

### Scheduled Commands

To check for overdue book loans and send notifications daily, set up the following command:

```bash
php artisan schedule:work
```

To run the command immediately, use:

```bash
php artisan check:book_Loan
```

--- 

© 2025 All Rights Reserved
