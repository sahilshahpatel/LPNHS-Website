<div class="flexContainer" style="margin: 0; padding: 0; position: relative; top: 0;">
    <div class="flexItemStart" id="contactUsFlexItem">
        <h3 style = "text-align: left">Contact Us</h3>
        <?php
            //Get president's information
            $sql = "SELECT * FROM students WHERE Position = :pos LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['pos' => 'President']);
            $presidentData = $stmt->fetchAll();
            if(!empty($presidentData)){
                echo '<p>', $presidentData[0][1], ' ', $presidentData[0][2], ': ', $presidentData[0][3], ' (President)</p>';
            }
            
            //Get advisors' information
            $sql = "SELECT * FROM students WHERE Position = :pos";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['pos' => 'Advisor']);
            $advisorData = $stmt->fetchAll();
            for($i = 0; $i<count($advisorData); $i++){
                echo '<p>', $advisorData[$i][1], ' ', $advisorData[$i][2], ': ', $advisorData[$i][3], ' (Advisor)</p>';
            }
        ?>
        <p>West Campus: 500 W. Bryn Mawr Ave. Roselle, IL 60172-1978</p>
    </div>
    <div class="flexItemStart" id="bugFlexItem">
        <h3 style = "text-align: left;">Found a Bug?</h3>
        <p>Report any issues to the site to the president, an advisor, or a site admin.</p>
        <p>The NHS website was created by two students, Ben Wagrez and Sahil  Patel, in 2018. By using the site and reporting errors and/or bugs, you are giving experience to the current computer science students at Lake Park.</p>
    </div>
    <div class="flexItemCenter" id="imageFlexItem">
        <img src = "img/NHS-LOGO-TM.png" id="NHSimageItem" style = "width: 137px; display: block; margin: 0 auto;" >
    </div>
</div>