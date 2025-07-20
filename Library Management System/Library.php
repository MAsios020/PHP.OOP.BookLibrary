<?php

namespace LibraryManagementSystem;



class Library
{

    public array $Books = [];
    public array $Members = [];




    public function AddBook($Book)
    {

        if ($Book instanceof book == false) {
            echo "Wrong Input";
            return;
        } else {
            array_push($this->Books, $Book);
            echo "Book Added Successfuly !";
        }
    }

    public function AddMember($Member)
    {

        if ($Member instanceof Member == false) {
            echo "Wrong Input";
            return;
        } else {
            array_push($this->Members, $Member);
            echo "Member Added Successfuly !";
        }
    }

    public function lendbook($Book, $Member)
    {

        if ($Book instanceof book == false || $Member instanceof Member == false) {
            echo "Wrong Input";
            return;
        } else {
            if ($Book->IsBorrowed) {
                echo "This Book Already Borrowed";
            } else {
                $Member->BorrowBook($Book);
            }
        }
    }

    public function returnbook($Book, $Member)
    {

        if ($Book instanceof book == false || $Member instanceof Member == false) {
            echo "Wrong Input";
            return;
        } else {
            if (!$Book->IsBorrowed) {
                echo "This Book is not borrowed";
            } else {
                $Member->ReturnBook($Book);
            }
        }
    }

    public function listAvailableBooks()
    {
        $availableBooks = array_filter($this->Books, function ($book) {
            return !$book->IsBorrowed;
        });

        if (empty($availableBooks)) {
            echo "No available books at the moment.";
        } else {
            foreach ($availableBooks as $book) {
                echo $book->DisplayInfo();
            }
        }
    }
    public function listBorrowedBooks()
    {
        $borrowedBooks = array_filter($this->Books, function ($book) {
            return $book->IsBorrowed;
        });

        if (empty($borrowedBooks)) {
            echo "No borrowed books at the moment.";
        } else {
            foreach ($borrowedBooks as $book) {
                echo $book->DisplayInfo();
            }
        }
    }

    public function ListMembers()
    {
        if (empty($this->Members)) {
            echo "No members registered.";
        } else {
            foreach ($this->Members as $member) {
                echo "Member ID: {$member->MemberID}, Name: {$member->Name}\n";
            }
        }
    }
}
