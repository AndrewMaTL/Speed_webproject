DROP DATABASE IF EXISTS spd4517; 

CREATE DATABASE spd4517; 

USE spd4517; 

DROP TABLE IF EXISTS spd4517, questionnaire; 

DROP TABLE IF EXISTS spd4517, answer; 

DROP TABLE IF EXISTS spd4517, Doctor; 

DROP TABLE IF EXISTS spd4517, Account; 

DROP TABLE IF EXISTS spd4517, user; 

DROP TABLE IF EXISTS spd4517, tips; 

DROP TABLE IF EXISTS spd4517, recommend_site; 

DROP TABLE IF EXISTS spd4517, fqa; 

DROP TABLE IF EXISTS spd4517, events; 



CREATE TABLE events( 

eventid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 

Doctor  Varchar(20) NOT NULL, 

eventname Varchar(300) NOT NULL,

eventdetail Varchar(2000) NOT NULL,  

dateOfpost DateTime NOT NULL

) ENGINE=INNODB;  




CREATE TABLE questionnaire( 

questionid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  

question Varchar(300) NOT NULL,  

correctAnswer BOOLEAN NOT NULL

) ENGINE=INNODB; 

 

CREATE TABLE answer( 

Questionid INT AUTO_INCREMENT NOT NULL,  

User Varchar(20) NOT NULL,

answer BOOLEAN NOT NULL,

 PRIMARY KEY (Questionid, User) 
)ENGINE=INNODB; 

 

CREATE TABLE Doctor( 

username varChar(20) PRIMARY KEY NOT NULL,  

fname varchar(20) NOT NULL,  

lname VarChar(20) NOT NULL,  

job_position VarChar(20) NOT NULL,  

DateOfbrith date NOT NULL,  

gender VarChar(20) NOT NULL,  

email VarChar(100) NOT NULL,  

contactno VarChar(8) NOT NULL,  

officeaddress VarChar(400) NOT NULL 

)ENGINE=INNODB; 



CREATE TABLE Account( 

Accountid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  

Account Varchar(20) NOT NULL, 

Password varChar(100) NOT NULL, 

AccountType Varchar(100) NOT NULL

)ENGINE=INNODB; 

 
 

CREATE TABLE user( 

username varChar(20) PRIMARY KEY  NOT NULL,  

fname VarChar(20) NOT NULL,  

lname VarChar(20) NOT NULL,  

DateOfbrith date NOT NULL,  

gender Varchar(5) NOT NULL,  

email VarChar(100) NOT NULL,  

contactno VarChar(8) NOT NULL,  

issueslevel int,

Score int,

address Varchar(100) NOT NULL  

)ENGINE=INNODB; 

 
 

CREATE TABLE tips( 

tipid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  

tip Varchar(200) NOT NULL,  

issueslevel int NOT NULL  

)ENGINE=INNODB; 

 
 

CREATE TABLE recommend_site( 

webid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  

webname VarChar(100) NOT NULL,  

web_address VarChar(100) NOT NULL,  

issueslevel int NOT NULL 

)ENGINE=INNODB; 

 
 

CREATE TABLE fqa( 

fqaid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  

question varchar(300) NOT NULL,  

answer varchar(2000) NOT NULL 

)ENGINE=INNODB; 

 
 
 

 INSERT INTO questionnaire (questionid, Question, correctAnswer) VALUES  
 (1, 'Are you basically satisfied with your life?', false), 
 (2, 'Have you dropped many of your activities and interests?', true),
 (3, 'Do you feel that your life is empty?', true), 
 (4, 'Do you often get bored?', true),
 (5, 'Are you hopeful about the future?', false), 
 (6, 'Are you bothered by thoughts you can t get out of your head?', true),
 (7, 'Are you in good spirits most of the time?', false),
 (8, 'Are you afraid that something bad is going to happen to you?', true),
 (9, 'Do you feel happy most of the time?', false), 
 (10, 'Do you often feel helpless?', true),
 (11, 'Do you often get restless and fidgety?', true),
 (12, 'Do you prefer to stay at home, rather than going out and doing new things?', true), 
 (13, 'Do you frequently worry about the future?', true), 
 (14, 'Do you feel you have more problems with memory than most?', true), 
 (15, 'Do you think it is wonderful to be alive now?', false), 
 (16, 'Do you often feel downhearted and blue?', true), 
 (17, 'Do you feel pretty worthless the way you are now?', true), 
 (18, 'Do you worry a lot about the past?', true),
 (19, 'Do you find life very exciting?', false), 
 (20, 'Is it hard for you to get started on new projects?', true), 
 (21, 'Do you feel full of energy?', false), 
 (22, 'Do you feel that your situation is hopeless?', true), 
 (23, 'Do you think that most people are better off than you are?', true), 
 (24, 'Do you frequently get upset over little things?', true), 
 (25, 'Do you frequently feel like crying?', true), 
 (26, 'Do you have trouble concentrating?', true), 
 (27, 'Do you enjoy getting up in the morning?', false), 
 (28, 'Do you prefer to avoid social gatherings?', true), 
 (29, 'Is it easy for you to make decisions?', false), 
 (30, 'Is your mind as clear as it used to be?', false)
 ;

 INSERT INTO fqa (fqaid, question, answer) VALUES  
 (1,'What is elderly depression?',"Depression is a mood disorder in which patients will have persistent low mood. The change in mood may be a result of negative life events. Old age may give you more reasons to feel down. You may have to deal with retirement, physical problems and death of a partner or friends. In spite of these difficulties, older people don\'t feel depressed all the time. About 7% of elderly suffers from depression. Whether a person will become depressed depends on his personality, coping skills, the amount of social support he has and his physical condition. Depression is caused by the disturbances of concentration of brain neurotransmitters. Therefore, it may be difficult to force a patient with moderate depression to think in a \"happy way\" unless the brain neurotransmitters have returned to their normal level. Medication is able to help to restore this neurotransmitter imbalance. One of the most undesirable and tragic complication of depression in elderly people is suicide. Those with more severe symptoms will have a higher risk of suicide. According to a research in 2000, in Hong Kong, the rate of suicide in elderly people is two to three times higher than the general population and 30% of all suicide deaths are aged 60 years or above About 90% of elderly suicide completers suffered from depression."),
 (2,'What are the causes of elderly depression?',"Painful events,Past depression,Physical illness can cause depression"),
 (3,'What are the symptoms of elderly depression?',"Mood and cognitive symptoms,Physical and behavioural symptoms,Other symptoms"),
 (4,'Why it is more difficult to diagnose depression in elderly?',"It is quite common that depressive symptoms are difficult to be detected in depressed elderly as they often focus on physical discomfort. They will also tend to avoid mentioning their emotional difficulties in front of doctors. Some depressed elderly will have anxiety symptoms as anxiety is commonly associated with depressive disorders. Sometimes it may be more obvious than depressive symptoms. They may be wrongly treated as an anxiety disorder and benzodiazepine may be prescribed instead of antidepressants.

Depression can affect memory and make patients feel confused. Some depressed elderly may be mistakenly diagnosed as dementia. Patients with depression worry about their memory loss while those with dementia do not. Therefore it is actually possible to distinguish between the two. On the other hand, it may be difficult to diagnose depression in an elderly with dementia. Interviewing the carer and observing the change in sleep and appetite of the patient can give us valuable information in making the correct diagnosis."),
 (5,'How to investigate and make diagnosis for elderly depression？',"If you observe that your relatives or friends have symptoms as mentioned above, you should encourage him or her to seek treatment from family doctor. He or she may need referral to a psychiatrist if needed. Depression is a syndromal diagnosis based on eliciting a specific cluster of symptoms through careful history taking and mental state examination, supplemented by relevant physical examination. No confirmatory laboratory test is available for diagnosing depression. The role of laboratory investigations, e.g. blood tests and brain scans, is to rule out diseases in other parts of body causing the depressive symptoms."),
 (6,'What are the treatments for elderly depression？',"There are 3 main modalities of treatment, they are pharmacological treatments, talking treatments and social support.Pharmacological treatment: antidepressants,Psychological treatment,Social support,Electroconvulsive therapy"),
 (7,'How to prevent elderly depression?',"In order to prevent depression in elderly, it is important to handle stress properly and to ensure there is enough rest. It is helpful to keep up with hobbies and interests and to stay in touch with friends and family for a better psychological well being.")
 ;


INSERT INTO recommend_site (webid, webname, web_address,issueslevel) VALUES (1,"The Institute of Mental Health (IMH), Castle Peak Hospital","http://www3.ha.org.hk/cph/imh/index.asp",3),
(2,"Hospital Authority – Elderly Suicide Prevention Programme","http://www.ha.org.hk/espp/",1),
(3,"The Royal College of Psychiatrists","https://www.rcpsych.ac.uk/",3),
(4,"The National Institute of Mental Health. Older Adults: Depression and Suicide Facts","https://www.nimh.nih.gov/index.shtml",2)
;  


INSERT into Doctor (username,fname,lname,job_position,DateOfbrith,gender,email,contactno,officeaddress) Values 
('d1','Jack','Sung','psychiatry','1970-06-26','male','1@ABCMail.com','31840880','Room 1234, Hang Lung Centre, 1 Paterson Street, Causeway Bay, Hong Kong'), 
('d2','Connor','Leung','psychiatry','1970-11-20','Female','2@ABCMail.com','45896597','Room 4456, Heng Shing Building, 321 Nathan Road, Kowloon.'), 
('d3','Callum','Mak','psychiatry','1971-12-13','Female','3@ABCMail.com','45812365','Room 123, Global Commercial Building, 12-13 Peking Road, Tsim Sha Tsui, Kowloon.'), 
('d4','Jacob','Chan','psychiatry','1972-05-19','Female','4@ABCMail.com','69531564','Room 4321, Hang Lung Centre, 1 Paterson Street, Causeway Bay, Hong Kong'), 
('d5','Kyle','Chan','psychiatry','1972-06-13','male','5@ABCMail.com','95842658','Room 2108, 21/F, Leighton Centre, 911 Leighton Road, Causeway Bay, Hong Kong'), 
('d6','Joe','Tang','psychiatry','1983-07-07','Female','6@ABCMail.com','78495625','Room 1412, Global Commercial Building, 12-13 Peking Road, Tsim Sha Tsui, Kowloon.'), 
('d7','Damian','Ma','psychiatry','1985-03-20','male','7@ABCMail.com','51235486','Room 21, Hang Lung Centre, 6541 Paterson Street, Causeway Bay, Hong Kong'), 
('d8','Tracy','Cheung','psychiatry','1985-05-07','male','8@ABCMail.com','36254965','Room 4321, Heng Shing Building, 123 Nathan Road, Kowloon.'), 
('d9','Victoria','Wong','psychiatry','1987-05-06','male','9@ABCMail.com','398547846','Room 1011, 10th Floor, Leighton Centre, 5 Leighton Road, Causeway Bay, Hong Kong'), 
('d10','Megan','Chiu','psychiatry','1988-05-30','male','10@ABCMail.com','94856123','Room 611, 6th Floor, Leighton Centre, 15 Leighton Road, Causeway Bay, Hong Kong')
;
INSERT into user (username,fname,lname, DateOfbrith,gender,email,contactno, address) Values 
('q1','Jacky','Chan','1949-03-06','male','u1@ABCMail.com','68159119','Room 0123, King Suite, 1 Queen Street, Causeway Bay, Hong Kong'), 
('q2','Connie','Leung','1950-06-12','Female','u2@ABCMail.com','54103402','Room 0465, Heng Seng Building, 321 Paking Road, Kowloon.'), 
('q3','Austin','Mok','1950-10-30','male','u3@ABCMail.com','54187634','Room 0321, No.1 Peking, 1 Peking Road, Tsim Sha Tsui, Kowloon.'), 
('q4','June','Chan','1951-05-08','Female','u4@ABCMail.com','90468435','Room 2143, Hung Hom Centre, 20 Hung Hom Road, Hung Hom, Kowloon'), 
('q5','Kyle','Korever','1952-06-31','male','u5@ABCMail.com','94157341','Room 2134, 21/F, Leighton Building, 119 Leighton Road, Causeway Bay, Hong Kong'), 
('q6','Felix','Tang','1953-01-17','male','u6@ABCMail.com','92150437','Room 1214, Habourview Suite, 12 Hung Lok Road, Hung Hom, Kowloon.'), 
('q7','Andrew','Ma','1955-09-12','male','u7@ABCMail.com','58764513','Room 0201, Edwardian Building, 45 victoria Street, Causeway Bay, Hong Kong'), 
('q8','Alex','Cheung','1955-06-07','male','u8@ABCMail.com','63745034','Room 1234, Nathan Building, 238 Nathan Road, Kowloon.'), 
('q9','Victor','Wong','1958-08-06','male','u9@ABCMail.com','60145215','Room 1110, 10th Floor, North Point Building, 5 Light Road, North Point, Hong Kong'), 
('q10','Ho','Chiu','1961-05-23','male','u10@ABCMail.com','95143876','Room 1116, 11th Floor, Prince Centre, 18 Prince Road, Mong Kok, Kowloon')
;
INSERT INTO tips (tipid, tip, issueslevel) VALUES 
(1,"Don't dismiss symptoms",2),
(2,"Talk about how they feel",1),
(3,"Look for subtle signs",1),
(4,"Don't impose your terminology",2),
(5,"Recognize that depression is an illness",3),
(6,"Don't take over a person's life",3),
(7,"Try to participate in medical care",3)
;  
INSERT INTO events (eventid,Doctor,eventname,eventdetail,dateOfpost) VALUES 
(1,'d1','Is the First tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 13:56'),
(2,'d2','Is the Second tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 08:20'),
(3,'d3','Is the Third tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 09:20'),
(4,'d4','Is the Forth tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 02:24'),
(5,'d5','Is the Fivth tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 23:20'),
(6,'d6','Is the Sixth tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 08:52'),
(7,'d7','Is the Seventh tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-15 08:20'),
(8,'d8','Is the Eighth tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-11 08:20'),
(9,'d9','Is the Nineth tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-14 08:12'),
(10,'d10','Is the brain tumor really so terrible?','In the minds of ordinary people, brain surgery is a terrible thing. When you hear someone want to be "opened up" by a doctor, everyone will think that there must be something in someone brain that needs to be removed. Tumor. More likely to worry about whether you will be confused after surgery, unclear and weak hands and feet. Really, brain tumors are not necessarily all "malignant", and today brain surgery is quite advanced and safe.','2019-04-16 22:20');

INSERT INTO Account (Accountid, Account, Password, AccountType) VALUES 
(1,"q1","123","User"),
(2,"q2","123","User"),
(3,"q3","123","User"),
(4,"q4","123","User"),
(5,"q5","123","User"),
(6,"q6","123","User"),
(7,"q7","123","User"),
(8,"q8","123","User"),
(9,"q9","123","User"),
(10,"q10","123","User"),
(11,"d1","123","Doctor"),
(12,"d2","123","Doctor"),
(13,"d3","123","Doctor"),
(14,"d4","123","Doctor"),
(15,"d5","123","Doctor"),
(16,"d6","123","Doctor"),
(17,"d7","123","Doctor"),
(18,"d8","123","Doctor"),
(19,"d9","123","Doctor"),
(20,"d10","123","Doctor")
;  