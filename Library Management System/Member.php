<?php


namespace LibraryManagementSystem;


class Member
{

    public $MemberID;
    public $Name;
    public $BorrowedBooks = [];

    public function __construct($_MemberID, $_MemberName)
    {
        $this->MemberID = $_MemberID;
        $this->Name = $_MemberName;
    }
    public function BorrowBook($Book)
    {

        if ($Book instanceof book == false) {
            echo "Wrong Input";
            return;
        } else {
            $Book->BorrowBook();
            array_push($this->BorrowedBooks, $Book);
            echo "Book Borrowed Successfuly !";
        }
    }

    public function ReturnBook($Book)
    {

        if ($Book instanceof book == false) {
            echo "Wrong Input";
            return;
        } else {

            unset($this->BorrowedBooks[array_search($Book, $this->BorrowedBooks)]);
            $Book->ReturnBook();
            echo "Book Returned Successfuly !";
        }
    }

    public function DisplayBorrowedbooks()
    {

        echo "Borrowed Book for : {$this->Name} with ID : {$this->MemberID}";
        foreach ($this->BorrowedBooks as $book) {
            echo "Book Name : {$book->Name}";
        }
    }
}
