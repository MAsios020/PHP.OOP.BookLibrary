<?php

namespace LibraryManagementSystem;



class book
{

    public $Title;
    public $author;
    public $ISBN;
    public $IsBorrowed;

    public function __construct($_Title, $_author, $_ISBN, $_IsBorrowed)
    {
        $this->Title = $_Title;
        $this->author = $_author;
        $this->ISBN = $_ISBN;
        $this->IsBorrowed = $_IsBorrowed;
    }

    public function BorrowBook()
    {

        if ($this->IsBorrowed == false) {
            $this->IsBorrowed = true;
            echo "Book borrowing done successfuly !";
        } else {
            echo "This Book Already Borrowed";
        }
    }

    public function    ReturnBook()
    {

        if ($this->IsBorrowed == true) {
            echo "Book Had Returned successfuly !";
            $this->IsBorrowed = false;
        } else {

            echo "SomeThing Went Wrong";
        }
    }

    public function DisplayInfo(): string
    {
        $Message = "📚 This book Name : {$this->Title} and its author : {$this->author} and its Isbn: {$this->ISBN}  and Avalibilty :{$this->IsBorrowed} 📚 \n";
        return $Message;
    }
}
