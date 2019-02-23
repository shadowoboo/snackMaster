        <div id="menu">
            <div id="logo">
                <img src="../../images/tina/LOGO1.png" alt="">
            </div>
            <p>Hi~ 管理員 <span id="manager"><?php echo $_SESSION['managerName'] ?></span></p>
            <p>你今天過得好嗎？</p>
            <ul id="menuUl">
                    <li>
                        <a href="back_snack.php">商品資料管理</a>
                    </li>
                    <li>
                        <a href="back_order.php">訂單管理</a>
                    </li>
                    <li>
                        <a href="back_member.php">會員管理</a>
                    </li>
                    <li>
                        <a href="back_coupon.php">優惠券管理</a>
                    </li>
                    <li>
                        <a href="back_rank.php">排行榜管理</a>
                    </li>
                    <li>
                        <a href="back_vending.php">販賣機管理</a>
                    </li>
                    <li>
                        <a href="back_material.php">客製化素材管理</a>
                    </li>
                    <li>
                        <a href="back_clearance.php">即期品專案管理</a>
                    </li>
                    <li>
                        <a href="back_evaReport.php">審核評價檢舉</a>
                    </li>
                    <li>
                        <a href="back_msgReport.php">審核留言檢舉</a>
                    </li>
                    <li>
                        <a href="back_manager.php">後台帳號管理</a>
                    </li>
                    <a href="back_logout.php" id="logout">登出</a>
            </ul>
        </div>
