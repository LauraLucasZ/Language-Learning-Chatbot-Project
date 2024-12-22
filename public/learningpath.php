<?php
session_start();

// Initialize the variables to avoid "undefined variable" warnings
$difficulty = $_SESSION['difficulty'] ?? '';  
$focusArea = $_SESSION['focusArea'] ?? '';
$personalInterests = $_SESSION['personalInterests'] ?? '';
$language = $_SESSION['language'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST
    $difficulty = $_POST['difficulty'] ?? '';
    $focusArea = $_POST['focusArea'] ?? '';
    $personalInterests = $_POST['personalInterests'] ?? '';
    $language = $_POST['languages'] ?? '';

    $_SESSION['difficulty'] = $difficulty;
    $_SESSION['focusArea'] = $focusArea;
    $_SESSION['personalInterests'] = $personalInterests;
    $_SESSION['language'] = $language;

    $_SESSION['update_message'] = 'Your learning path has been updated successfully!';
}
include_once "../Language-Learning-Chatbot/controllers/learningpathcontroller.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizable Language Learning Path</title>
    <link rel="stylesheet" href="./css/Stylehome.css">
    <link rel="stylesheet" href="./css/styleuserprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .title-strip {
            background-color: #4D1193;
            height: 30px;
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container" style="padding-right: 0px; padding-left: 0px;">
    <?php include "../Language-Learning-Chatbot/views/partials/navbar.php"; ?>
    <div class="main-content">
        <div class="title-strip" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 60px; background-color: #4D1193;">
            <h6 class="mb-3" style="color:white; margin: 10px; text-align:center; font-weight: bold;">Customize Your Learning Path</h6>
        </div>

        <form action="../public/learningpath.php" method="POST">
            <div class="row gutters">
                <!-- Difficulty Level Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="color:#4D1193;">Difficulty Level</h6>
                    <div class="form-group">
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="beginner" id="difficultyBeginner" name="difficulty" <?php echo ($difficulty == 'beginner') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="difficultyBeginner">Beginner</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="intermediate" id="difficultyIntermediate" name="difficulty" <?php echo ($difficulty == 'intermediate') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="difficultyIntermediate">Intermediate</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="advanced" id="difficultyAdvanced" name="difficulty" <?php echo ($difficulty == 'advanced') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="difficultyAdvanced">Advanced</label>
                        </div>
                    </div>
                </div>

                <!-- Focus Areas Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="color:#4D1193;">Focus Areas</h6>
                    <div class="form-group">
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" name="focusArea" value="grammar" id="focusGrammar" <?php echo ($focusArea == 'grammar') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="focusGrammar">Grammar</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" name="focusArea" value="vocabulary" id="focusVocabulary" <?php echo ($focusArea == 'vocabulary') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="focusVocabulary">Vocabulary</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" name="focusArea" value="writing" id="focusWriting" <?php echo ($focusArea == 'writing') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="focusWriting">Writing</label>
                        </div>
                    </div>
                </div>

                <!-- Personal Interests Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="color:#4D1193;">Personal Interests</h6>
                    <div class="form-group">
                        <textarea class="form-control" id="personalInterests" name="personalInterests" rows="3" placeholder="Describe your interests..."><?php echo htmlspecialchars($personalInterests); ?></textarea>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="color:#4D1193;">Languages</h6>
                    <div class="form-group">
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="english" id="languageEnglish" name="languages" <?php echo ($language == 'english') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="languageEnglish">English</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="french" id="languageFrench" name="languages" <?php echo ($language == 'french') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="languageFrench">French</label>
                        </div>
                        <div class="form-check" style="color:#4D1193;">
                            <input class="form-check-input" type="radio" value="spanish" id="languageSpanish" name="languages" <?php echo ($language == 'spanish') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="languageSpanish">Spanish</label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right" style="color:#4D1193;">
                        <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>

        <?php if (isset($_SESSION['update_message'])): ?>
            <div id="popupAlert" class="popup-alert">
                <div class="popup-content">
                    <p><?php echo $_SESSION['update_message']; ?></p>
                    <button id="closePopup" class="popup-close-btn">Close</button>
                </div>
            </div>
            <?php unset($_SESSION['update_message']); ?>  
        <?php endif; ?>
    </div>
</div>

<script src="../public/js/userProfile.js"></script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/userProfile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
