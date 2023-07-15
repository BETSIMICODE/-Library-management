-- Creation of the database as well as the existing tables

create database biblioBd;

use  biblioBd;

create table admin(admin_mail char(30) not null, admin_name char(30) not null, admin_password char(30) not null, primary key (admin_mail));

create table author (author_id int(4) not null AUTO_INCREMENT, author_name char(30) not null, author_f_name char(30), author_nick_name char(30), primary key (author_id));

create table member (member_id int(4) not null AUTO_INCREMENT, member_name char(30) not null, member_f_name char(30), member_address char(30) not null, member_phone char(10) not null, card_year int(4) not null,primary key (member_id));

create table book( book_id int(4) not null AUTO_INCREMENT, book_title char(30) not null, book_kind char(30) not null, book_type char(30) not null, book_number int(4) not null, book_free_number int(4) not null, book_penalty int(4) default 0, author_id int(4) not null, primary key (book_id), foreign key (author_id) references author(author_id));

create table loan (loan_id int(4) not null AUTO_INCREMENT, loan_date date not null, return_date date, book_id int(4) not null, penalty_cost int(8) default 0, member_id int(4) not null, primary key (loan_id),  foreign key (book_id) references book(book_id),  foreign key (member_id) references member(member_id));


--Trigger that will fire before the update of the loan table and will update the value of the penalty_cost column based on the difference in dates.
DELIMITER //
CREATE TRIGGER update_penalty_cost
BEFORE INSERT ON loan
FOR EACH ROW
BEGIN
    DECLARE days_diff INT;
    SET days_diff = DATEDIFF(NEW.return_date, NEW.loan_date);
    IF days_diff > 30 THEN
        SET NEW.penalty_cost = (days_diff - 30) * (SELECT book_penalty FROM book WHERE book_id = NEW.book_id);
    ELSE
        SET NEW.penalty_cost = 0;
    END IF;
END //
DELIMITER ;

