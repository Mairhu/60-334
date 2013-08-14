SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dbRestaurant` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `dbRestaurant` ;

-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblMenuCategory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblMenuCategory` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblMenuCategory` (
  `intMenuCategoryID` INT NOT NULL AUTO_INCREMENT ,
  `strMenuCategoryName` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`intMenuCategoryID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblMenuItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblMenuItem` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblMenuItem` (
  `intMenuItemID` INT NOT NULL AUTO_INCREMENT ,
  `intMenuNumber` INT NOT NULL ,
  `txtMenuItemName` TEXT NOT NULL ,
  `txtDescription` TEXT NOT NULL ,
  `intMenuCategoryID` INT NOT NULL ,
  `dblPrice` DOUBLE NOT NULL ,
  `strSize` VARCHAR(45) NULL DEFAULT NULL ,
  `blnSpicy` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`intMenuItemID`) ,
  CONSTRAINT `fk_menuItem1`
    FOREIGN KEY (`intMenuCategoryID` )
    REFERENCES `dbRestaurant`.`tblMenuCategory` (`intMenuCategoryID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblUserType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblUserType` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblUserType` (
  `intUserTypeID` INT NOT NULL AUTO_INCREMENT ,
  `strUserTypeName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`intUserTypeID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblUser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblUser` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblUser` (
  `intUserID` INT NOT NULL AUTO_INCREMENT ,
  `strFirstName` VARCHAR(45) NOT NULL ,
  `strLastName` VARCHAR(45) NOT NULL ,
  `strEmail` VARCHAR(100) NOT NULL ,
  `strUserName` VARCHAR(60) NOT NULL ,
  `strPassword` VARCHAR(60) NOT NULL ,
  `strPhone` VARCHAR(15) NOT NULL ,
  `intUserType` INT NOT NULL ,
  `dtmLastLogin` DATETIME ,
  `dtmCreatedOn` DATETIME NOT NULL ,
  `intCreatedBy` INT ,
  `intModifiedBy` INT NULL ,
  `dtmModifiedOn` DATETIME NULL ,
  PRIMARY KEY (`intUserID`) ,
  INDEX `fk_user1_idx` (`intUserType` ASC) ,
  INDEX `fk_user2_idx` (`intModifiedBy` ASC) ,
  UNIQUE INDEX `strUserName_UNIQUE` (`strUserName` ASC) ,
  CONSTRAINT `fk_user1`
    FOREIGN KEY (`intUserType` )
    REFERENCES `dbRestaurant`.`tblUserType` (`intUserTypeID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user2`
    FOREIGN KEY (`intCreatedBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user3`
    FOREIGN KEY (`intModifiedBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblOrder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblOrder` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblOrder` (
  `intOrderID` INT NOT NULL AUTO_INCREMENT ,
  `intUserID` INT NOT NULL ,
  `strContactPhone` VARCHAR(15) NOT NULL ,
  `strType` ENUM('Dine In','Pick-up','Delivery') NOT NULL ,
  `strState` ENUM('New','Viewed','Ready','Complete') NOT NULL DEFAULT 'New' ,
  `dtmApplicableTime` DATETIME NOT NULL ,
  `dtmCreatedOn` DATETIME NOT NULL ,
  PRIMARY KEY (`intOrderID`) ,
  INDEX `fk_order1_idx` (`intUserID` ASC) ,
  CONSTRAINT `fk_order1`
    FOREIGN KEY (`intUserID` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblOrderDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblOrderDetail` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblOrderDetail` (
  `intOrderPartID` INT NOT NULL AUTO_INCREMENT ,
  `intOrderID` INT NOT NULL ,
  `intMenuItemID` INT NOT NULL ,
  `intQuantity` INT NOT NULL ,
  `blnComplete` TINYINT(1) NOT NULL DEFAULT false ,
  PRIMARY KEY (`intOrderPartID`) ,
  INDEX `fk_orderDetail1_idx` (`intOrderID` ASC) ,
  INDEX `fk_orderDetail2_idx` (`intMenuItemID` ASC) ,
  CONSTRAINT `fk_orderDetail1`
    FOREIGN KEY (`intOrderID` )
    REFERENCES `dbRestaurant`.`tblOrder` (`intOrderID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orderDetail2`
    FOREIGN KEY (`intMenuItemID` )
    REFERENCES `dbRestaurant`.`tblMenuItem` (`intMenuItemID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblPage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblPage` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblPage` (
  `intPageID` INT NOT NULL AUTO_INCREMENT ,
  `strPageName` VARCHAR(45) NULL ,
  `strClassName` VARCHAR(45) NULL ,
  PRIMARY KEY (`intPageID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblUserPageXR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblUserPageXR` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblUserPageXR` (
  `intUserTypeID` INT NOT NULL ,
  `intPageID` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`intUserTypeID`, `intPageID`) ,
  INDEX `fk_UserPageXR2_idx` (`intUserTypeID` ASC) ,
  INDEX `fk_UserPageXR_idx` (`intPageID` ASC) ,
  CONSTRAINT `fk_UserPageXR`
    FOREIGN KEY (`intPageID` )
    REFERENCES `dbRestaurant`.`tblPage` (`intPageID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UserPageXR2`
    FOREIGN KEY (`intUserTypeID` )
    REFERENCES `dbRestaurant`.`tblUserType` (`intUserTypeID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblThread`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblThread` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblThread` (
  `intThreadID` INT NOT NULL AUTO_INCREMENT,
  `strThreadName` VARCHAR(45) NOT NULL ,
  `blnActive` TINYINT(1) NOT NULL ,
  `dtmCreatedOn` DATETIME NOT NULL ,
  `intCreatedBy` INT NOT NULL ,
  `dtmModifiedOn` DATETIME NULL ,
  `intModfiedOn` INT NULL ,
  PRIMARY KEY (`intThreadID`) ,
  INDEX `fk_Thread3_idx` (`intModfiedOn` ASC) ,
  INDEX `fk_Thread2_idx` (`intCreatedBy` ASC) ,
  CONSTRAINT `fk_Thread2`
    FOREIGN KEY (`intCreatedBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Thread3`
    FOREIGN KEY (`intModfiedOn` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblPost`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblPost` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblPost` (
  `intPostID` INT NOT NULL AUTO_INCREMENT,
  `intThreadID` INT NOT NULL ,
  `txtContent` TEXT NOT NULL ,
  `dtmCreatedOn` DATETIME NOT NULL ,
  `intCreatedBy` INT NOT NULL ,
  `dtmModifiedOn` DATETIME NULL ,
  `blnDisabled` TINYINT(1) NULL ,
  `intDisabledBy` INT NULL ,
  PRIMARY KEY (`intPostID`) ,
  INDEX `fk_post2_idx` (`intCreatedBy` ASC) ,
  INDEX `fk_post1_idx` (`intThreadID` ASC) ,
  INDEX `fk_post3_idx` (`intDisabledBy` ASC) ,
  CONSTRAINT `fk_post1`
    FOREIGN KEY (`intThreadID` )
    REFERENCES `dbRestaurant`.`tblThread` (`intThreadID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post2`
    FOREIGN KEY (`intCreatedBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post3`
    FOREIGN KEY (`intDisabledBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbRestaurant`.`tblMessage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbRestaurant`.`tblMessage` ;

CREATE  TABLE IF NOT EXISTS `dbRestaurant`.`tblMessage` (
  `intMessageID` INT NOT NULL AUTO_INCREMENT,
  `strEmail` VARCHAR(100) NOT NULL ,
  `strName` VARCHAR(100) NOT NULL ,
  `txtMessage` TEXT NOT NULL ,
  `strState` ENUM('New','Read','Responded') NOT NULL ,
  `intModifiedBy` INT NULL ,
  PRIMARY KEY (`intMessageID`) ,
  INDEX `fk_message1_idx` (`intModifiedBy` ASC) ,
  CONSTRAINT `fk_message1`
    FOREIGN KEY (`intModifiedBy` )
    REFERENCES `dbRestaurant`.`tblUser` (`intUserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `dbRestaurant` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO tblUserType (intUserTypeID, strUserTypeName)
VALUES (1, "Owner"), (2, "Administrator"), 
			 (3, 'Forum Moderator'), (4, "General User");

INSERT INTO tblUser (strFirstName, strLastName, strEmail, strUserName,
									strPassword, strPhone, intUserType,
									dtmCreatedOn)
VALUES ("System","System", "no-reply@test.com", "System", SHA1('system'), "519-999-9999", 1, NOW() ),
			("Admin","Admin", "admin@test.com", "Admin", SHA1('admin'), "519-999-9999", 1, NOW() ),
			("Ping", "Yong", "yongp@uwindsor.ca", "pyong", SHA1('yongp'), "519-562-8031", 2, NOW());

INSERT INTO tblThread (strThreadName, blnActive, dtmCreatedOn,
									 intCreatedBy)
VALUES ("FAQ", 1, NOW(), 1), ("Ask a Question", 1, NOW(), 1), ("Suggestions", 1, NOW(), 1), ("Reviews", 1, NOW(), 1);
									
