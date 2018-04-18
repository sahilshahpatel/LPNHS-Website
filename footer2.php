<!DOCTYPE HTML>
<?php
    require 'database.php';
    session_start();
?>
<html>
	<head>
		<title>test</title>
		<style>
			.flexContainer{
				display: flex;
				align-items: center;
				justify-content: center;
                width: 100%;
			}
			.flexItemStart{
				margin: 0px auto;
                align-self: flex-start;
            }
            .flexItemStart p{
                margin: 5px auto;
                white-space: pre-wrap;
            }
            .flexItemCenter {
                margin: 0 auto;
                align-self: center;
            }
            #contactUsFlexItem p{
                margin: 5px auto;
            }
            footer {
                margin: 0px;
                padding: 20px;
                width: calc(100% - 20px);
                position: absolute;
                left: 0;
                background-color: #333;
                color: #bbb;
                font-family: Bookman, sans-serif;
            }
		</style>
	</head>
    <body>
        <footer id= "footer">
            <div class="flexContainer" style="margin: 0; padding: 0; position: relative; top: 0;">
                <div class="flexItemStart" id="contactUsFlexItem">
		            <h3>Contact Us</h3>
                    <?php
                        $sql = "SELECT * FROM students WHERE Position = :pos LIMIT 1";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['pos' => 'President']);
                        $presidentData = $stmt->fetchAll();
                        if(!empty($presidentData)){
                            echo '<p>', $presidentData[0][1], ' ', $presidentData[0][2], ': ', $presidentData[0][3], ' (President)</p>';
                        }
                    ?>
			        <p>Patrice Lovelace: plovelace@lphs.org (Advisor)</p>
                    <p>Pia Laudadio: plaudadio@lphs.org (Advisor)</p>
                    <p>West Campus: 500 W. Bryn Mawr Ave. Roselle, IL 60172-1978</p>
                </div>
                <div class="flexItemStart">
                    <h3>Found a Bug?</h3>
                    <p>Report any issues to the site to the president, an advisor, or a site admin.</p>
                    <p>The NHS website was created by two students, Ben Wagrez and Sahil  Patel, in 2018.</p>
                    <p>By using the site and reporting errors and/or bugs, you are giving experience to the</p>
                    <!--Insert Tab-->
                    <p>&#09current computer science students at Lake Park.</p>
                </div>
                <div class="flexItemStart">
                    <img src = "img/NHS-LOGO-TM.png" style = "width: 137px">
                </div>
            </div>
        </footer>
    </body>
</html>