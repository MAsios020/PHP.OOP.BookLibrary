<?php

namespace LibraryManagementSystem;

use LibraryManagementSystem\Book;
use LibraryManagementSystem\Member;
use LibraryManagementSystem\Library;

require_once 'Book.php';
require_once 'Member.php';
require_once 'Library.php';

function prompt_input($prompt)
{
    echo $prompt;
    return trim(fgets(STDIN));
}
echo "--- Library Management System - Interactive Test ---\n\n";

$myLibrary = new Library();

while (true) {
    echo "\n--- Main Menu ---\n";
    echo "1. 📚 Add New Book\n";
    echo "2. 🧑‍🤝‍🧑 Add New Member\n";
    echo "3. ➡️  Lend Book\n";
    echo "4. ⬅️  Return Book\n";
    echo "5. 📖 List Available Books\n";
    echo "6. 🔎 List Borrowed Books\n";
    echo "7. 🚪 Exit\n";
    echo "-------------------\n";

    $choice = prompt_input("Enter your choice: ");

    switch ($choice) {
        case '1': // Add New Book
            echo "\n--- Add New Book ---\n";
            $title = prompt_input("Enter book title: ");
            $author = prompt_input("Enter book author: ");
            $isbn = prompt_input("Enter book ISBN: ");
            $book = new Book($title, $author, $isbn, false);
            $myLibrary->addBook($book);
            echo "✅ Book '{$book->Title}' added successfully!\n";
            break;

        case '2': // Add New Member
            echo "\n--- Add New Member ---\n";
            $name = prompt_input("Enter member name: ");
            $memberId = prompt_input("Enter member ID: ");
            $member = new Member($name, $memberId);
            $myLibrary->addMember($member);
            echo "✅ Member '{$member->Name}' added successfully!\n";
            break;

        case '3': // Lend Book
            echo "\n--- Lend Book ---\n";
            if (empty($myLibrary->Books) || empty($myLibrary->Members)) {
                echo "❌ Please add books and members first.\n";
                break;
            }
            $myLibrary->listAvailableBooks();
            $bookTitle = prompt_input("Enter title of book to lend: ");
            $memberIdToLend = prompt_input("Enter ID of member: ");

            $bookToLend = null;
            foreach ($myLibrary->Books as $b) {
                if ($b->Title === $bookTitle) {
                    $bookToLend = $b;
                    break;
                }
            }

            $memberToLend = null;
            foreach ($myLibrary->Members as $m) {
                if ($m->MemberID === $memberIdToLend) {
                    $memberToLend = $m;
                    break;
                }
            }

            if ($bookToLend && $memberToLend) {
                $myLibrary->lendBook($bookToLend, $memberToLend);
            } else {
                echo "❌ Book or Member not found.\n";
            }
            break;

        case '4': // Return Book
            echo "\n--- Return Book ---\n";
            if (empty($myLibrary->books) || empty($myLibrary->members)) {
                echo "❌ No books or members to process.\n";
                break;
            }
            $myLibrary->listBorrowedBooks();
            $bookTitleToReturn = prompt_input("Enter title of book to return: ");
            $memberIdToReturn = prompt_input("Enter ID of member returning book: ");

            $bookToReturn = null;
            foreach ($myLibrary->Books as $b) {
                if ($b->Title === $bookTitleToReturn) {
                    $bookToReturn = $b;
                    break;
                }
            }

            $memberToReturn = null;
            foreach ($myLibrary->Members as $m) {
                if ($m->MemberID === $memberIdToReturn) {
                    $memberToReturn = $m;
                    break;
                }
            }

            if ($bookToReturn && $memberToReturn) {
                if ($myLibrary->returnbook($bookToReturn, $memberToReturn)) {
                    echo "✅ Book '{$bookToReturn->Title}' returned by '{$memberToReturn->Name}' successfully!\n";
                } else {
                    echo "⚠️ Could not return book (not borrowed by this member or other issue).\n";
                }
            } else {
                echo "❌ Book or Member not found.\n";
            }
            break;

        case '5': // List Available Books
            echo "\n--- Available Books ---\n";
            $myLibrary->listAvailableBooks();
            break;

        case '6': // List Borrowed Books
            echo "\n--- Borrowed Books ---\n";
            $myLibrary->listBorrowedBooks();
            break;

        case '7': // Exit
            echo "\n👋 Exiting Library System. Goodbye!\n";
            exit(); 
            break;

        case '8': // List Members
            echo "\n👋 Members\n";
            $myLibrary->ListMembers();
            break;


        default:
            echo "\n❌ Invalid choice. Please try again.\n";
            break;
    }

    echo "\nPress Enter to continue...";
    fgets(STDIN); 
}
