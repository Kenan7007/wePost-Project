-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 04:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wepost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@mail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(50) NOT NULL,
  `published_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`, `published_posts`) VALUES
(1, 'author1', 'author1@mail.com', 'author1', 2),
(2, 'author2', 'author2@mail.com', 'author2', 0),
(5, 'author3', 'author3@mail.com', 'author3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryDate`) VALUES
(2, 'Technology', '2021-03-27 22:14:21'),
(3, 'Programming Languages', '2021-03-27 22:50:28'),
(4, 'Android', '2021-04-01 09:53:01'),
(6, 'Culture', '2021-04-07 17:48:47'),
(7, 'Sciences', '2021-04-07 17:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_nr` int(11) NOT NULL,
  `person` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_nr`, `person`, `post_id`, `content`, `date`) VALUES
(14, 'author1', 7, 'lkn', '2021-05-10 00:12:18'),
(22, 'user3', 6, 'Helllooooo', '2021-05-10 03:09:58'),
(24, 'user1', 22, 'new', '2021-05-10 03:48:44'),
(30, 'Admin1', 22, 'ewewew', '2021-05-10 03:56:39'),
(31, 'user2', 22, 'Helllooooo', '2021-05-10 03:57:03'),
(32, 'author2', 22, 'sfsfs', '2021-05-10 03:57:35'),
(34, 'author1', 6, 'Awesomee!', '2021-05-11 01:07:49'),
(35, 'user1', 6, 'nice article', '2021-05-11 01:09:28'),
(36, 'Costy', 7, 'Nice article', '2021-05-11 17:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `postTitle` varchar(200) NOT NULL,
  `postCategory` varchar(200) NOT NULL,
  `postImg` varchar(200) NOT NULL,
  `postContent` text NOT NULL,
  `postDate` datetime NOT NULL DEFAULT current_timestamp(),
  `postAuthor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postTitle`, `postCategory`, `postImg`, `postContent`, `postDate`, `postAuthor`) VALUES
(2, 'An overview of the Java language', 'Programming Languages', '452_java.jpg', 'WHY JAVA?\r\nJava is a programming language and computing platform first released by Sun Microsystems in 1995. Java is a programming language built for the age of the Internet. There are lots of applications and websites that will not work unless you have Java installed, and more are created every day. Java is fast, secure, and reliable. From laptops to datacenters, game consoles to scientific supercomputers, cell phones to the Internet, Java is everywhere!\r\n\r\nIntroduction to Java Technology\r\nImagine you\'re a software application developer. Your programming language of choice (or the language that\'s been foisted on you) is C or C++. You\'ve been at this for quite a while and your job doesn\'t seem to be getting any easier. These past few years you\'ve seen the growth of multiple incompatible hardware architectures, each supporting multiple incompatible operating systems, with each platform operating with one or more incompatible graphical user interfaces. Now you\'re supposed to cope with all this and make your applications work in a distributed client-server environment. The growth of the Internet, the World-Wide Web, and \"electronic commerce\" have introduced new dimensions of complexity into the development process. The tools you use to develop applications don\'t seem to help you much. You\'re still coping with the same old problems; the fashionable new object-oriented techniques seem to have added new problems without solving the old ones. You say to yourself and your friends, \"There has to be a better way\"!\r\n\r\nThe Better Way is Here Now\r\nNow there is a better way -- the Java programming language platform from Sun Microsystems.\r\n\r\nYour Java programming language is object oriented, yet it\'s still dead simple.\r\nYour development cycle is much faster because Java technology is interpreted. The compile-link-load-test-crash-debug cycle is obsolete--now you just compile and run.\r\nYour applications are portable across multiple platforms. Write your applications once, and you never need to port them--they will run without modification on multiple operating systems and hardware architectures.\r\nYour applications are robust because the Java runtime environment manages memory for you.\r\nYour interactive graphical applications have high performance because multiple concurrent threads of activity in your application are supported by the multithreading built into the Java programming language and runtime platform.\r\nYour applications are adaptable to changing environments because you can dynamically download code modules from anywhere on the network.\r\nYour end users can trust that your applications are secure, even though they\'re downloading code from all over the Internet; the Java runtime environment has built-in protection against viruses and tampering.\r\nJava is one of the world\'s most widely used computer language. Java is a simple, general-purpose, object-oriented, interpreted, robust, secure, architecture-neutral, portable, high-performance, multithreaded computer language. It is intended to let application developers \"write once, run anywhere\" (WORA), meaning that code that runs on one platform does not need to be recompiled to run on another.\r\n\r\nJava technology is both a programming language and a platform.\r\n\r\nJava is a high level, robust, secured and object-oriented programming language. And any hardware or software environment in which a program runs, is known as a platform. Since Java has its own runtime environment (JRE) and API, it is called platform.\r\n\r\nIn the Java programming language, all source code is first written in plain text files ending with the .java extension. Those source files are then compiled into .class files by the javac compiler. A .class file does not contain code that is native to your processor; it instead contains bytecodes — the machine language of the Java Virtual Machine1 (Java VM). The java launcher tool then runs your application with an instance of the Java Virtual Machine', '2021-03-29 20:01:45', 'author1'),
(5, 'Technology evolution and its impact on traditional jobs', 'Technology', '696_567_530_770_IT_development.jpg', 'The forecast shows that technological change may accelerate known employment trends, such as the shift to services, and may also increase polarisation in job growth, with fast growth projected for high-skill occupations and moderate growth for certain lower-skill jobs. Employment levels in medium-skill occupations will experience a hollowing out, with occupations such as skilled manual workers and clerks, likely to decline or stay the same, as automation and offshoring take their toll. In that context, a rethink of traditional vocational education and training is needed.\r\n\r\nCedefop Acting Director Mara Brugia told a high-level event in Brussels where the new forecast was presented: ‘The goal of forecasting is not to predict the future but to help us to make informed choices to avoid deciding on education and training investments in the dark. Acting proactively is more effective, and often cheaper, than fixing adverse effects at a later stage.’\r\n\r\nCedefop collaborated with Eurofound to predict future skills needed in different types of jobs, using the European jobs monitor framework. Eurofound Director Juan Menéndez-Valdés said: ‘This is another concrete example exploiting two of the agencies’ most prominent tools, the Cedefop skills forecast and the European jobs monitor, to get even more added value.’\r\n\r\nManufacturing is the main sector affected by both global trade and automation, with economic growth projected to show no creation of new jobs and even job losses. However, some high-value-added sectors, including electrical equipment, other machinery, and equipment manufacturing and motor vehicles, are expected to see substantial employment growth. Employment is also forecast to increase in computer, optical and electronic equipment.\r\n\r\nService sectors will experience the fastest employment growth, notably legal and accounting services, research and development, advertising and market research, along with administrative and support service activities.\r\n\r\nChair of Cedefop Governing Board Tatjana Babrauskiene said: ‘The most critical challenge we will have to address in the decade to come is job polarisation, which reduces the amount of good and well-paid jobs. Polarisation means widening inequalities between those who have access to good-quality and skills-intensive work and those who end up being low-paid employees in inferior jobs.’\r\n\r\nDirector-General, DG Employment, Social Affairs and Inclusion Joost Korte concluded: ‘Cedefop’s skills forecast is an important EU-level data source. It is essential for the work we do in Brussels in the context of the European Semester and to shape the skills for the future labour markets.\"\"\"\"\"\"', '2021-03-29 21:45:52', 'author1'),
(6, 'Information about the importance of reading', 'Culture', '486_reading.jpg', 'Why is Reading Important?\r\nWhy is reading important exactly? What’s all this talk and excitement really about? There’s plenty of reasons why reading is a beneficial practice.\r\n\r\n \r\n\r\n \r\n\r\n1. Reading Expands the Mind\r\n \r\n\r\nFor starters, reading helps to expand the mind and give us more ideas. Reading has been proven to keep our minds young, healthy and sharp, with studies showing that reading can even help prevent alzheimer’s disease.\r\n\r\n \r\n\r\nThe study closely examined 294 eldery women and men in their 80s, and gave them mentally stimulating tasks, including reading and writing. They were also given memory and thinking tests annually in their last years to keep track of their progress. After they died, autopsies showed that those who had engaged in such activities had a slower rate of memory decline compared to those who hadn’t read.\r\n\r\n \r\n\r\nReading also develops the imagination and allows us to dream and think in ways that we would have never been able to before.\r\n\r\n \r\n\r\n \r\n\r\n2. Reading Allows for Creative Thinking\r\n \r\n\r\nAnother one of the many reasons why reading is important is that it allows for creative thinking. Reading can inspire you when you are feeling bored, down or in a rut.. It can help give you that very needed pick-me-up without having to search too far for it. Reading helps get the creative side of your brain thinking, unlike television that really does not use much creative brain power.\r\n\r\n \r\n\r\n \r\n\r\n3. Reading Helps Improve Concentration\r\n \r\n\r\nIf you are still unconvinced or unsure about the importance of reading, or feel as though it’s not beneficial for you personally, then it’s important to note that reading actually helps improve concentration. Reading can train our mind how to focus properly, which is invaluable in nearly everything we do on a daily basis — whether it be as we study or even in our careers and in our personal relationships. We could all benefit from practicing our concentration skills.\"\"', '2021-04-03 19:11:33', 'author3'),
(7, 'The most important programming languages in 2021', 'Programming Languages', '837_topIn2021.jpg', 'Top 10 Most Popular Programming Languages:\r\n1. Python\r\nNumber of jobs: 19,000\r\n\r\nAverage annual salary: $120,000\r\n\r\nBenefits: Python is widely regarded as a programming language that’s easy to learn, due to its simple syntax, a large library of standards and toolkits, and integration with other popular programming languages such as C and C++. In fact, it’s the first language that students learn in the Align program, Gorton says. “You can cover a lot of computer science concepts quickly, and it’s relatively easy to build on.” It is a popular programming language, especially among startups, and therefore Python skills are in high demand.\r\n\r\nDrawbacks: Python is not suitable for mobile application development.\r\n\r\nCommon uses: Python is used in a wide variety of applications, including artificial intelligence, financial services, and data science. Social media sites such as Instagram and Pinterest are also built on Python.\r\n\r\n2. JavaScript\r\nNumber of jobs: 24,000\r\n\r\nAverage annual salary: $118,000\r\n\r\nBenefits: JavaScript is the most popular programming language for building interactive websites; “virtually everyone is using it,” Gorton says. When combined with Node.js, programmers can use JavaScript to produce web content on the server before a page is sent to the browser, which can be used to build games and communication applications that run directly in the browser. A wide variety of add-ons extend the functionality of JavaScript as well. \r\n\r\nDrawbacks: Internet browsers can disable JavaScript code from running, as JavaScript is used to code pop-up ads that in some cases can contain malicious content. \r\n\r\nCommon uses: JavaScript is used extensively in website and mobile application development. Node.js allows for the development of browser-based applications, which do not require users to download an application.\r\n\r\n3. Java\r\nNumber of jobs: 29,000\r\n\r\nAverage annual salary: $104,000\r\n\r\nBenefits: Java is the programming language most commonly associated with the development of client-server applications, which are used by large businesses around the world. Java is designed to be a loosely coupled programming language, meaning that an application written in Java can run on any platform that supports Java. As a result, Java is described as the “write once, run anywhere” programming language.\r\n\r\nDrawbacks: Java is not ideal for applications that run on the cloud, as opposed to the server (which is common for business applications). In addition, the software company Oracle, which owns Java, charges a licensing fee to use the Java Development Kit.\r\n\r\nCommon uses: Along with business applications, Java is used extensively in the Android mobile operating system.\r\n\r\n4. C#\r\nNumber of jobs: 18,000\r\n\r\nAverage annual salary: $97,000\r\n\r\nBenefits: Microsoft developed C# as a faster and more secure variant of C. It is fully integrated with Microsoft’s .NET software framework, which supports the development of applications for Windows, browser plug-ins, and mobile devices. C# offers shared codebases, a large code library, and a variety of data types.\r\n\r\nDrawbacks: C# can have a steep learning curve, especially for resolving errors. It is less flexible than languages such as C++. \r\n\r\nCommon uses: C# is the go-to language for Microsoft ad Windows application development. It can also be used for mobile devices and video game consoles using an extension of the .NET Framework called Mono.\r\n\r\n5. C\r\nNumber of jobs: 8,000\r\n\r\nAverage annual salary: $97,000\r\n\r\nBenefits: Along with Python and Java, C forms a “good foundation” for learning how to program, Gorton says. As one of the first programming languages ever developed, C has served as the foundation for writing more modern languages such as Python, Ruby, and PHP. It is also an easy language to debug, test, and maintain.\r\n\r\nDrawbacks: Since it’s an older programming language, C is not suitable for more modern use cases such as websites or mobile applications. C also has a complex syntax as compared to more modern languages.\r\n\r\nCommon uses: Because it can run on any type of device, C is often used to program hardware, such as embedded devices in automobiles and medical devices used in healthcare. \r\n\r\n6. C++\r\nNumber of jobs: 9,000\r\n\r\nAverage annual salary: $97,000\r\n\r\nBenefits: C++ is an extension of C that works well for programming the systems that run applications, as opposed to the applications themselves. C++ also works well for multi-device and multi-platform systems. Over time, programmers have written a large set of libraries and compilers for C++. Being able to use these utilities effectively is just as important to understanding a programming language as writing code, Gorton says.\r\n\r\nDrawbacks: Like C, C++ has complex syntax and an abundance of features that can make it complicated for new programmers. C++ also does not support run-time checking, which is a method of detecting errors or defects while software is running. \r\n\r\nCommon uses: C++ has many uses and is the language behind everything from computer games to mathematical simulations.\r\n\r\n7. Go\r\nNumber of jobs: 1,700\r\n\r\nAverage annual salary: $93,000\r\n\r\nBenefits: Also referred to as Golang, Go was developed by Google to be an efficient, readable, and secure language for system-level programming. It works well for distributed systems, in which systems are located on different networks and need to communicate by sending messages to each other. While it is a relatively new language, Go has a large standards library and extensive documentation.\r\n\r\nDrawbacks: Go has not gained widespread use outside of Silicon Valley. Go does not include a library for graphical user interfaces, which are the most common ways that end-users interact with any device that has a screen.\r\n\r\nCommon uses: Go is used primarily for applications that need to process a lot of data. In addition to Google, companies using Go for certain applications include Netflix, Twitch, and Uber.\r\n\r\n8. R\r\nNumber of jobs: 1,500\r\n\r\nAverage annual salary: $93,000\r\n\r\nBenefits: R is heavily used in statistical analytics and machine learning applications. The language is extensible and runs on many operating systems. Many large companies have adopted R in order to analyze their massive data sets, so programmers who know R are in great demand. \r\n\r\nDrawbacks: R does not have the strict programming guidelines of older and more established languages. \r\n\r\nCommon uses: R is primarily used in statistical software products. \r\n\r\n9. Swift\r\nNumber of jobs: 1,800\r\n\r\nAverage annual salary: $93,000 \r\n\r\nBenefits: Swift is Apple’s language for developing applications for Mac computers and Apple’s mobile devices, including the iPhone, iPad, and Apple Watch. Like many modern programming languages, Swift has a highly readable syntax, runs code quickly, and can be used for both client-side and server-side development. \r\n\r\nDrawbacks: Swift can only be used on newer versions of iOS 7 and will not work with older applications. As a newer programming language, the code can be unstable at times, and there are fewer third-party resources available to programmers.\r\n\r\nCommon uses: Swift is used for iOS and macOS applications. \r\n\r\n10. PHP\r\nNumber of jobs: 7,000\r\n\r\nAverage annual salary: $81,000\r\n\r\nBenefits: PHP is widely used for server-side web development, when a website frequently requests information from a server. As an older language, PHP benefits from a large ecosystem of users who have produced frameworks, libraries, and automation tools to make the programming language easier to use. PHP code is also easy to debug.\r\n\r\nDrawbacks: As Python and JavaScript have gained popularity, PHP’s popularity has dropped. PHP is also known for its security vulnerabilities. According to Indeed, most PHP programmers take short-term roles that last less than one year.\r\n\r\nCommon uses: PHP is the code running content-oriented websites such as Facebook, WordPress, and Wikipedia. \"\"', '2021-04-07 18:06:55', 'author3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(300) NOT NULL,
  `publishedPosts` int(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `publishedPosts`, `password`) VALUES
(2, 'user1', 'user1@mail.com', 0, 'user1'),
(3, 'user2', 'user2@mail.com', 0, 'user2'),
(4, 'user3', 'user3@mail.com', 0, 'user3'),
(7, 'Costy', 'abc@yahoo.com', 0, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_nr`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_nr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
