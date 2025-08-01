-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1

-- Generation Time: Dec 22, 2024 at 12:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: llchatbot_db
--

-- --------------------------------------------------------

--
-- Table structure for table activities
--

CREATE TABLE activities (
  activity_id int(11) NOT NULL,
  activity_type enum('quiz','challenge','reading','vocabGame') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--

-- Table structure for table `challenge_data`
--

CREATE TABLE `challenge_data` (
  `user_id` int(11) NOT NULL,
  `challenge_id` INT AUTO_INCREMENT PRIMARY KEY,
  `question_id` int(11) NOT NULL,
  `user_input` text NOT NULL,
  `ai_feedback` text NOT NULL,
  `challenge_score` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_question`
--

CREATE TABLE `challenge_question` (
  `question_id` int(11) NOT NULL,
  `challenge_category` varchar(20) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL,
  `question_text` text NOT NULL,
  `language_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenge_question`
--

INSERT INTO `challenge_question` (`question_id`, `challenge_category`, `difficulty_level`, `question_text`, `language_category`) VALUES
(1, 'Grammar', 'Beginner', 'Write a short paragraph describing your daily routine, ensuring proper use of present tense verbs.', 'English'),
(2, 'Grammar', 'Intermediate', 'Compose a short story where you use at least five different conjunctions and three types of clauses.', 'English'),
(3, 'Grammar', 'Advance', 'Write a formal letter of complaint about a recent service experience, focusing on correct punctuation, sentence structure, and passive voice.', 'English'),
(4, 'Vocabulary', 'Beginner', 'Write a paragraph about your favorite hobby, using at least five adjectives to describe why you enjoy it.', 'English'),
(5, 'Vocabulary', 'Intermediate', 'Describe your ideal vacation using at least three synonyms for the word \"beautiful\" and two antonyms for \"boring.\"', 'English'),
(6, 'Vocabulary', 'Advance', 'Write an essay about the importance of technology in education, incorporating advanced vocabulary such as \"ubiquitous,\" \"transformative,\" and \"paradigm shift.\"', 'English'),
(7, 'Grammar', 'Beginner', 'Rédigez un court paragraphe décrivant votre routine quotidienne en utilisant correctement le présent de l’indicatif.', 'French'),
(8, 'Grammar', 'Intermediate', 'Écrivez une petite histoire dans laquelle vous utilisez au moins cinq conjonctions différentes et trois types de propositions.', 'French'),
(9, 'Grammar', 'Advance', 'Rédigez une lettre formelle de réclamation concernant un service récent, en mettant l’accent sur une ponctuation correcte, une structure de phrase appropriée et l’utilisation de la voix passive.', 'French'),
(10, 'Vocabulary', 'Beginner', 'Écrivez un paragraphe sur votre passe-temps favori en utilisant au moins cinq adjectifs pour expliquer pourquoi vous l’appréciez.', 'French'),
(11, 'Vocabulary', 'Intermediate', 'Décrivez vos vacances idéales en utilisant au moins trois synonymes de \"magnifique\" et deux antonymes de \"ennuyeux\".', 'French'),
(12, 'Vocabulary', 'Advance', 'Rédigez un essai sur l’importance de la technologie dans l’éducation, en intégrant un vocabulaire avancé tel que \"omniprésent\", \"révolutionnaire\" et \"changement de paradigme\".', 'French'),
(13, 'Grammar', 'Beginner', 'Escribe un breve párrafo describiendo tu rutina diaria, asegurándote de usar correctamente los verbos en presente.', 'Spanish'),
(14, 'Grammar', 'Intermediate', 'Escribe una pequeña historia en la que utilices al menos cinco conjunciones diferentes y tres tipos de oraciones subordinadas.', 'Spanish'),
(15, 'Grammar', 'Advance', 'Escribe una carta formal de queja sobre un servicio reciente, centrándote en el uso correcto de la puntuación, la estructura de las oraciones y la voz pasiva.', 'Spanish'),
(16, 'Vocabulary', 'Beginner', 'Escribe un párrafo sobre tu pasatiempo favorito, utilizando al menos cinco adjetivos para explicar por qué te gusta.', 'Spanish'),
(17, 'Vocabulary', 'Intermediate', 'Describe tus vacaciones ideales utilizando al menos tres sinónimos de \"hermoso\" y dos antónimos de \"aburrido\".', 'Spanish'),
(18, 'Vocabulary', 'Advance', 'Escribe un ensayo sobre la importancia de la tecnología en la educación, incorporando vocabulario avanzado como \"omnipresente\", \"transformador\" y \"cambio de paradigma\".', 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

CREATE TABLE `chatmessages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `response` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatmessages`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--


CREATE TABLE `forum_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table Chats
--
CREATE TABLE Chats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- --------------------------------------------------------

--

-- Table structure for table ChatMessages
--
CREATE TABLE ChatMessages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id INT NOT NULL, -- Link to the Chats table
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    response TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES Chats(id) ON DELETE CASCADE
);
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table language_analysis
--

CREATE TABLE language_analysis (
  languageAnalysis_id int(11) NOT NULL,
  language_name varchar(50) NOT NULL,
  usage_percentage decimal(5,2) NOT NULL,
  common_topics varchar(255) NOT NULL,
  user_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table quiz_questions
--


CREATE TABLE `quiz_questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('MCQ','fill-in-the-blank','true/false') NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL,
  `language_category` varchar(20) NOT NULL,
  `points` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--


INSERT INTO `quiz_questions` (`question_id`, `question_text`, `question_type`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `difficulty_level`, `language_category`, `points`, `activity_id`)
VALUES
(1, 'What is the opposite of "Hot"?', 'MCQ', 'Cold', 'Warm', 'Cool', 'Freezing', 'Cold', 'Beginner', 'English', 10, 5),
(2, 'Select the correct plural form of "Leaf".', 'MCQ', 'Leaves', 'Leafe', 'Leafs', 'Leafes', 'Leaves', 'Beginner', 'English', 10, 5),
(3, 'Which sentence is correct: "She are reading."', 'MCQ', 'She is reading.', 'She are reading.', 'She was reading.', 'She reads.', 'She is reading.', 'Beginner', 'English', 10, 5),
(4, 'Choose the synonym for "Happy".', 'MCQ', 'Sad', 'Joyful', 'Angry', 'Ecstatic', 'Joyful', 'Beginner', 'English', 10, 5),
(5, 'Fill in the blank: "I ___ to the park."', 'fill-in-the-blank', 'go', 'went', 'gone', '', 'go', 'Beginner', 'English', 10, 5),
(6, 'The sun ___ in the sky.', 'fill-in-the-blank', 'shines', 'shone', 'shining', '', 'shines', 'Beginner', 'English', 10, 5),
(7, 'He ___ a book yesterday.', 'fill-in-the-blank', 'read', 'reads', 'reading', '', 'read', 'Beginner', 'English', 10, 5),
(8, 'Is it raining?', 'true/false', 'True', 'False', '', '', 'True', 'Beginner', 'English', 10, 5),
(9, 'Mountains are higher than hills.', 'true/false', 'True', 'False', '', '', 'True', 'Beginner', 'English', 10, 5),
(10, 'Birds can fly.', 'true/false', 'True', 'False', '', '', 'True', 'Beginner', 'English', 10, 5),

-- English Intermediate
(11, 'Choose the correct word for "Beautiful".', 'MCQ', 'Beautiful', 'Prettier', 'Ugliest', 'Magnificent', 'Beautiful', 'Intermediate', 'English', 15, 5),
(12, 'Select the correct synonym for "Strong".', 'MCQ', 'Weak', 'Tough', 'Feeble', 'Robust', 'Tough', 'Intermediate', 'English', 15, 5),
(13, 'Fill in the blank: "They ___ dancing at the party."', 'fill-in-the-blank', 'were', 'are', 'have been', '', 'were', 'Intermediate', 'English', 15, 5),
(14, 'Which sentence is grammatically correct: "She don’t like coffee."', 'MCQ', 'She doesn’t like coffee.', 'She don’t like coffee.', 'She not like coffee.', 'She likes coffee.', 'She doesn’t like coffee.', 'Intermediate', 'English', 15, 5),
(15, 'The river ___ fast today.', 'fill-in-the-blank', 'flows', 'flowed', 'flowing', '', 'flows', 'Intermediate', 'English', 15, 5),
(16, 'Choose the correct answer: "I ___ go to school tomorrow."', 'fill-in-the-blank', 'am going to', 'go to', 'will go', '', 'am going to', 'Intermediate', 'English', 15, 5),
(17, 'Correct the sentence: "She does not knows the answer."', 'MCQ', 'She does not know the answer.', 'She does not knows the answer.', 'She does know the answer.', 'She knows the answer.', 'She does not know the answer.', 'Intermediate', 'English', 15, 5),
(18, 'Is the moon round?', 'true/false', 'True', 'False', '', '', 'True', 'Intermediate', 'English', 15, 5),
(19, 'Elephants are mammals.', 'true/false', 'True', 'False', '', '', 'True', 'Intermediate', 'English', 15, 5),
(20, 'You should always check the spellings.', 'true/false', 'True', 'False', '', '', 'True', 'Intermediate', 'English', 15, 5),

-- English Advanced
(21, 'Choose the correct word for "Eloquent".', 'MCQ', 'Fluent', 'Verbose', 'Clumsy', 'Articulate', 'Fluent', 'Advanced', 'English', 20, 5),
(22, 'Select the correct synonym for "Erudite".', 'MCQ', 'Ignorant', 'Learned', 'Simple', 'Educated', 'Learned', 'Advanced', 'English', 20, 5),
(23, 'Fill in the blank: "The cat ___ out the window."', 'fill-in-the-blank', 'looked', 'looks', 'looking', '', 'looked', 'Advanced', 'English', 20, 5),
(24, 'Which sentence is correct: "He might of gone."', 'MCQ', 'He might have gone.', 'He might of gone.', 'He might goes.', 'He must have gone.', 'He might have gone.', 'Advanced', 'English', 20, 5),
(25, 'The storm ___ over the sea.', 'fill-in-the-blank', 'rages', 'raged', 'raging', '', 'rages', 'Advanced', 'English', 20, 5),
(26, 'Correct the sentence: "It is more better to ask first."', 'MCQ', 'It is better to ask first.', 'It is more better to ask first.', 'It is best to ask first.', 'It is most better to ask first.', 'It is better to ask first.', 'Advanced', 'English', 20, 5),
(27, 'Is gravity a force?', 'true/false', 'True', 'False', '', '', 'True', 'Advanced', 'English', 20, 5),
(28, 'Quantum physics explores subatomic particles.', 'true/false', 'True', 'False', '', '', 'True', 'Advanced', 'English', 20, 5),
(29, 'Synonyms enhance vocabulary.', 'true/false', 'True', 'False', '', '', 'True', 'Advanced', 'English', 20, 5),
(30, 'Communication is key to understanding.', 'true/false', 'True', 'False', '', '', 'True', 'Advanced', 'English', 20, 5),

-- French Beginner
(31, 'Quelle est la traduction correcte de "Maison"?', 'MCQ', 'Maison', 'Bateau', 'Voiture', 'Hôtel', 'Maison', 'Beginner', 'French', 10, 5),
(32, 'Quel est le pluriel de "Fleur"?', 'MCQ', 'Fleurs', 'Fleures', 'Fleureses', 'Fleuries', 'Fleurs', 'Beginner', 'French', 10, 5),
(33, 'Choisissez la phrase correcte : "Je vais ___ école."', 'MCQ', 'à', 'au', 'dans', 'vers', 'à', 'Beginner', 'French', 10, 5),
(34, 'Quelle est la traduction correcte de "Water"?', 'MCQ', 'Eau', 'Pain', 'Chat', 'Vin', 'Eau', 'Beginner', 'French', 10, 5),
(35, 'Je ___ un café hier.', 'fill-in-the-blank', 'ai', 'es', 'a', 'e', 'ai', 'Beginner', 'French', 10, 5),
(36, 'Ils ___ à la maison.', 'fill-in-the-blank', 'sont', 'est', 'étaient', 'estent', 'sont', 'Beginner', 'French', 10, 5),
(37, 'Nous ___ les devoirs.', 'fill-in-the-blank', 'avons', 'as', 'est', 'aime', 'avons', 'Beginner', 'French', 10, 5),
(38, 'Elle ___ un gâteau.', 'fill-in-the-blank', 'a fait', 'fait', 'faisait', 'faites', 'a fait', 'Beginner', 'French', 10, 5),
(39, 'Je ___ à la plage.', 'fill-in-the-blank', 'étais', 'étaient', 'était', 'étions', 'étais', 'Beginner', 'French', 10, 5),
(40, 'Le soleil se lève à l\'ouest.', 'true/false', 'Vrai', 'Faux', '', '', 'Faux', 'Beginner', 'French', 10, 5),

-- French Intermediate
(41, 'Quelle est la traduction correcte de "Éloquent"?', 'MCQ', 'Fluent', 'Verbose', 'Clumsy', 'Articulate', 'Fluent', 'Intermediate', 'French', 15, 5),
(42, 'Sélectionnez le synonyme correct de "Fort".', 'MCQ', 'Faible', 'Tough', 'Feeble', 'Robust', 'Tough', 'Intermediate', 'French', 15, 5),
(43, 'Complétez la phrase : "Ils ___ dansant à la fête."', 'fill-in-the-blank', 'étaient', 'sont', 'ont été', 'danse', 'étaient', 'Intermediate', 'French', 15, 5),
(44, 'Quelle phrase est correcte : "Elle n\'aime pas le café."', 'MCQ', 'Elle n’aime pas le café.', 'Elle n’aime pas le café.', 'Elle n’aime pas du café.', 'Elle ne boit pas de café.', 'Elle n’aime pas le café.', 'Intermediate', 'French', 15, 5),
(45, 'Le fleuve ___ rapidement aujourd\'hui.', 'fill-in-the-blank', 'coule', 'coule', 'courait', 'continue', 'coule', 'Intermediate', 'French', 15, 5),
(46, 'Corrigez la phrase : "Il ne sait pas l\'heure."', 'MCQ', 'Il ne sait pas l’heure.', 'Il ne sait pas l’heure.', 'Il ne sait pas de l’heure.', 'Il sait l’heure.', 'Il ne sait pas l’heure.', 'Intermediate', 'French', 15, 5),
(47, 'La gravité est une force.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Intermediate', 'French', 15, 5),
(48, 'La physique quantique explore les particules subatomiques.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Intermediate', 'French', 15, 5),
(49, 'Les synonymes enrichissent le vocabulaire.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Intermediate', 'French', 15, 5),
(50, 'La communication est essentielle pour comprendre.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Intermediate', 'French', 15, 5),

-- French Advanced
(51, 'Quelle est la traduction correcte de "Érudite"?', 'MCQ', 'Ignorant', 'Appris', 'Simple', 'Éduqué', 'Appris', 'Advanced', 'French', 20, 5),
(52, 'Sélectionnez le synonyme correct de "Éloquent".', 'MCQ', 'Fluide', 'Verbose', 'Clumsy', 'Articulate', 'Fluide', 'Advanced', 'French', 20, 5),
(53, 'Complétez la phrase : "La pluie ___ sur le toit."', 'fill-in-the-blank', 'tombe', 'tomber', 'tombait', '', 'tombe', 'Advanced', 'French', 20, 5),
(54, 'Quelle phrase est correcte : "Il aurait dû venir."', 'MCQ', 'Il aurait dû venir.', 'Il aurait dû viennent.', 'Il aurait dû viendre.', 'Il aurait dû vienne.', 'Il aurait dû venir.', 'Advanced', 'French', 20, 5),
(55, 'Le temps ___ très chaud aujourd\'hui.', 'fill-in-the-blank', 'est', 'fut', 'était', '', 'est', 'Advanced', 'French', 20, 5),
(56, 'Corrigez la phrase : "Nous avons rencontrer des problèmes."', 'MCQ', 'Nous avons rencontré des problèmes.', 'Nous avons rencontrer des problèmes.', 'Nous avons recontré des problèmes.', 'Nous avons rencontrés des problèmes.', 'Nous avons rencontré des problèmes.', 'Advanced', 'French', 20, 5),
(57, 'La science explore des concepts complexes.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Advanced', 'French', 20, 5),
(58, 'Les mathématiques sont essentielles dans de nombreuses disciplines.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Advanced', 'French', 20, 5),
(59, 'La littérature classique est souvent étudiée à l\'école.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Advanced', 'French', 20, 5),
(60, 'La philosophie explore des questions profondes sur la vie.', 'true/false', 'Vrai', 'Faux', '', '', 'Vrai', 'Advanced', 'French', 20, 5);


-- --------------------------------------------------------

--

-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `confirmPassword` varchar(128) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `gender` text NOT NULL,
  `role` text NOT NULL,
  `language` text NOT NULL,
  `score` text NOT NULL,
  `profileImage` text NOT NULL,
  `progress` int(11) NOT NULL,
  `postsCount` int(11) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL,
  `focus_area` varchar(50) NOT NULL,
  `personal_interests` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `email`, `password`, `confirmPassword`, `firstName`, `lastName`, `gender`, `role`, `language`, `score`, `profileImage`, `progress`, `postsCount`, `difficulty_level`, `focus_area`, `personal_interests`) VALUES
(1, 'aya22', 'aya22@miu.com', '$2y$10$Musvv2Orx.yGM1A37dnQTe6F2UyE1ILQkYUDNgGH3buGLfjslTOAe', '$2y$10$5yV3AhuezyNaSGqMaJJYm.lEyj3wLiJP7S6OMbrbLwtwojk5JocZ6', 'aya', 'hisham', 'female', 'student', 'French', '0', '../public/images/user.png', 0, 0, 'Beginner', '', ''),
(2, 'admin_user', 'admin2@example.com', '$2y$10$sD7ggOVVdySH/doShNoaS..hCSfbdsPOSykvD.tJYqhGF9vnlvPi.', '12345Admin2*', 'Admin', 'User', 'male', 'admin', 'English', '0', '', 0, 0, 'beginner', '', ''),
(3, 'asel', 'asel@m.com', '$2y$10$ClDlbPnnmwn43WB/FLAT7O96RTOUmG5U0.7RigGn91kEC3k5qWupi', '$2y$10$vgVLSoWTRPc.nvJaICSosu3kbyZdjXkWHwyJQczRg/d0GBu3jrKB.', 'asel', 'hisham', 'female', 'student', 'German', '0', '../public/images/user.png', 0, 0, 'Beginner', '', ''),
(4, 'pinar3', 'pinar3@m.com', '$2y$10$6VEBXYwsfewrafW7/ydD7OQ4VuxysTspslkxNUGbbJm2HOiZRYkwO', '', 'Admin', 'User', '', 'student', 'English', '', '../public/images/user.png', 0, 0, '', '', ''),
(6, 'lolo123', 'laura@gmail.com', '$2y$10$vEn9uJDwtMK1Pk9d96GQYO9eHIypu5FXUP/zUCNgORx4z9hvH4p3u', '$2y$10$pWfvpMAGniq.6WUwH.lbzuX9f8w2WDe2MkbTZqBq8G1VM0b0UxYQ2', 'laura', 'lucas', 'female', 'student', 'Mandarin', '0', '../public/images/user.png', 0, 0, 'advanced', 'vocabulary', ''),


-- --------------------------------------------------------

--
-- Table structure for table user_progress
--

CREATE TABLE user_progress (
  user_progress_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  conversation_date date NOT NULL,
  conversation_score int(11) NOT NULL,
  vocabulary_focus_grammar int(11) NOT NULL,
  vocabulary_focus_pronunciation int(11) NOT NULL,
  vocabulary_focus_vocabulary int(11) NOT NULL,
  correction_grammar int(11) NOT NULL,
  correction_pronunciation int(11) NOT NULL,
  correction_vocabulary int(11) NOT NULL,
  activity_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--

-- Table structure for table `user_solved_questions`
--

CREATE TABLE `user_solved_questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` text NOT NULL,
  `solved_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE vocabulary (
  vocab_gane_id int(11) NOT NULL,
  activity_id int(11) NOT NULL,
  game_name int(11) NOT NULL,
  game_description int(11) NOT NULL,
  vocab_list int(11) NOT NULL,
  points int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table activities
--
ALTER TABLE activities
  ADD PRIMARY KEY (activity_id);

--

-- Indexes for table `challenge_data`
--
ALTER TABLE `challenge_data`
  ADD PRIMARY KEY (`challenge_id`),
  ADD KEY `fk_challenges_question_id` (`question_id`),
  ADD KEY `foreign_key_user` (`user_id`);

--
-- Indexes for table `challenge_question`
--
ALTER TABLE `challenge_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--

-- AUTO_INCREMENT for table `chatmessages`
--
ALTER TABLE `chatmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


--
-- AUTO_INCREMENT for table users
--

ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


--
-- Constraints for dumped tables
--

--

-- Constraints for table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD CONSTRAINT `chatmessages_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;