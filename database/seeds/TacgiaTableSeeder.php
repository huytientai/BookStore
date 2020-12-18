<?php

use Illuminate\Database\Seeder;

class TacgiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\tacgia::truncate();
        //factory(\App\Models\tacgia::class, 10)->create();

        \App\Models\tacgia::create([
            'id' => '1',
            'name' => 'Xact Group',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0977636696',
            'address' => 'Hà Nội',
            'image' => '1.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '2',
            'name' => 'Nguyen Văn Thân',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0977636696',
            'address' => 'Hà Nội',
            'image' => '2.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '3',
            'name' => 'Trần Văn Nghĩa',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0986588767',
            'address' => 'Hà Nội',
            'image' => '3.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '4',
            'name' => 'Phạm Tam',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',

            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0903864228',
            'address' => 'TP. Hồ Chí Minh',
            'image' => '4.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '5',
            'name' => 'Nguyễn Thủy Liên',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0912492295',
            'address' => 'Hà Nội',
            'image' => '5.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '6',
            'name' => 'Kamachi Kazuma',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '',
            'address' => 'Nhật Bản',
            'image' => '6.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '7',
            'name' => 'Hoài Thanh',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0903998399',
            'address' => 'Cà mau',
            'image' => '7.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '8',
            'name' => 'Dale Carnegie',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '02485858745',
            'address' => 'Vinh',
            'image' => '8.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '9',
            'name' => 'Trần Trường Minh',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0907135688',
            'address' => 'Hà Nội',
            'image' => '9.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);

        \App\Models\tacgia::create([
            'id' => '10',
            'name' => 'Phạm Hồng',
            'born' => '31 July 1990',
            'nationality' => 'Viet Nam',
            'desc' => 'As a child, Rowling attended St Michael\'s Primary School, a school founded by abolitionist William Wilberforce and education reformer Hannah More. Her headmaster at St Michael\'s, Alfred Dunn, has been suggested as the inspiration for the Harry Potter headmaster Albus Dumbledore. She attended secondary school at Wyedean School and College, where her mother worked in the science department. Steve Eddy, her first secondary school English teacher, remembers her as "not exceptional" but "one of a group of girls who were bright, and quite good at English". Rowling took A-levels in English, French and German, achieving two As and a B and was head girl.

In 1982, Rowling took the entrance exams for Oxford University but was not accepted and earned a BA in French and Classics at the University of Exeter. Martin Sorrell, a French professor at Exeter, remembers "a quietly competent student, with a denim jacket and dark hair, who, in academic terms, gave the appearance of doing what was necessary". Rowling recalls doing little work, preferring to read Dickens and Tolkien. After a year of study in Paris, Rowling graduated from Exeter in 1986. In 1988, Rowling wrote a short essay about her time studying Classics titled "What was the Name of that Nymph Again? or Greek and Roman Studies Recalled"; it was published by the University of Exeter\'s journal Pegasus',
            'email' => Str::random(10) . '@gmail.com',
            'phone' => '0918838146',
            'address' => 'Hà Nội',
            'image' => '10.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
    }
}
