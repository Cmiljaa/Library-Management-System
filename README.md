# Library Management System

### Features Overview

#### 1. **Authentication**

-   **Google Authentication**: Allows users to log in with their Google accounts.
-   **Login, Logout, Register**: Email and password login, logout, and account registration.

#### 2. **Books**

-   **Search Books**: Users can search for books using keywords.
-   **Filter Books**: Filter books by genre or language.
-   **Sorting**: Options to sort books by popularity, number of reviews, etc.

#### 3. **Members**

-   **Account Management**: Members can create accounts, log in, and manage their profiles.
-   **Book Loans History**: View and sort their history of book loans by borrow date, return date, or status.
-   **Profile Management**: Update or delete their profile.
-   **Book Reviews**: Add, edit, or delete book reviews.
-   **Notifications**: Receiving notifications about overdue fees.

-   **Favorites**: Members can add books to their favorites list.

#### 4. **Librarians**

-   **Account Access**: Log in and register as librarians.
-   **Book Loans Management**: Create, update, or view book loans. Search book loans by borrow/return date or status.
-   **Member Management**: Update or delete member profiles, search for members by first name, last name, or email, and view their book loans history.
-   **Overdue Fees**: Librarians can delete overdue fees.

-   **Favorites**: Librarians can add books to their favorites list.

#### 5. **Admins**

-   **Settings Management**:

    -   Set the overdue fees amount.
    -   Define the maximum number of books a user can borrow.
    -   Set the loan duration (in days).

-   **Role Assignment**: Admins can assign roles (member, librarian, or admin) to users.

-   **Overdue Fees Management**: Admins can **delete overdue fees**.
    -   Route: `DELETE /notifications/{notification}`
-   **Favorites**: Admins can add books to their favorites list.

---

### Features and Role-Based Access

#### **1. Authentication**

-   **Login & Register**: All users (members, librarians, and admins) can register and log in with email/password or Google authentication.

    -   Guest users can access the login and registration routes.

#### **2. Books**

-   **View Books**: Everyone can **view** the list of books and their details.
    -   Route: `GET /books`, `GET /books/{book}` (accessible by everyone)
-   **Manage Books**: Only **librarians** and **admins** can **create, edit, or delete books**.

    -   Route: `POST /books`, `PUT /books/{book}`, `DELETE /books/{book}` (accessible by librarians and admins)

-   **Search & Filter Books**: All users can search for books and filter by genre or language.
-   **Sorting**: Options to sort books by popularity, number of reviews, etc.

#### **3. Members**

-   **Login & Register**: Members can create an account and log in.
    -   Routes: `GET /auth/login`, `GET /auth/register` (accessible by guests)
-   **Book Loans History**: Members can view and sort their book loans.
    -   Route: `GET /users/{user}/book_loans` (only accessible by the member themselves or admins/librarians)
-   **Manage Profile**: Members can update their profile details and delete their account.
    -   Routes: `GET /users/{user}/edit`, `PUT /users/{user}`, `DELETE /users/{user}` (only accessible by the member themselves or admins/librarians)
-   **Add/Edit/Delete Reviews**: **Only members** can add, edit, or delete reviews for books.

    -   Routes: `POST /reviews` (create), `PUT /reviews/{review}`, `DELETE /reviews/{review}` (only accessible by the member who created the review)

-   **Notifications**: Personal notifications, including overdue fees.
    -   Route: `GET /notifications` (accessible by the member themselves)
-   **Favorites**: Add books to a favorites list.
    -   Route: `POST /favorites/{book}`

#### **4. Librarians**

-   **Manage Users**: Librarians can view the list of users, their profiles, and manage book loans.
    -   Route: `GET /users`, `GET /users/{user}/book_loans` (view user data and loans)
-   **Book Loans Management**: Librarians can create, update, or view book loans.

    -   Routes: `GET /book_loans`, `PUT /book_loans/{loan}`, `POST /book_loans` (accessible by librarians and admins)

-   **Overdue Fees Management**: Librarians can **delete overdue fees** for members.

    -   Route: `DELETE /notifications/{notification}`

-   **Favorites**: Add books to a favorites list.

    -   Route: `POST /favorites/{book}`

-   **Cannot Add/Edit/Delete Reviews**: Librarians **cannot** manage reviews. Reviews can only be managed by the member who created them.

#### **5. Admins**

-   **Settings Management**: Only **admins** can access and modify application-wide settings like overdue fees, max books allowed, and loan durations.

    -   Routes: `GET /settings, GET /settings/{setting}/edit, PUT /settings/{setting}` (accessible only by admins)

-   **Role Management**: Admins can assign roles (member, librarian, admin) to users.

-   **Overdue Fees Management**: Admins can **delete overdue fees** for members.

    -   Route: `DELETE /notifications/{notification}`

-   **Favorites**: Add books to a favorites list.
    -   Route: `POST /favorites/{book}`

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

    - Create a database and update your `.env` file:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=your_username
        DB_PASSWORD=your_password
        ```

5. **Run Migrations and Seed Data**

    ```bash
    php artisan migrate
    php artisan db:seed

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
php artisan check:book_loan
```

---

© 2025 All Rights Reserved
