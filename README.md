# <!-- Exercise title -->

### exercise in week 13 - 15 (20/12/2021 - 07/01/2022)<!-- NR (from date - to date)--> of our BeCode training
You can find the original exercise readme [by clicking here](https://github.com/becodeorg/ANT-Lamarr-5.34/tree/main/3.The-Mountain/SCRUM)

## Table of content

|     |                                                                         |
| --- | ----------------------------------------------------------------------- |
| 1   | [Challenge](#challenge)                                                 |
| 2   | [The objective of this exercise](#the-objective-of-this-exercise)       |
| 3   | [The group](#the-group)                                                 |
| 4   | [Tools and languages used](#tools-and-languages-used)                   |
| 5   | [Timeline](#timeline)                                                   |
| 6   | [What I learned from this exercise](#what-i-learned-from-this-exercise) |
| 7   | [To Do](#to-do)                                                         |
| 8   | [Installation Instructions](#installation-instructions)                 |
|     |

## 1. Challenge

We're building a project from start to finish using SCRUM principles.
* From a first client briefing we have to build a MVP that fits their needs and wishes
* Work according to SCRUM
* Appoint a SCRUM master
* Create tickets based on user stories
* Assign tickets based on preferences in the team
* Keep an overview of the project using github projects, monday.com, trello ... whichever works
* Deliver a finished MVP by the deadline

## 2. The objective of this exercise

* Learn to work in a SCRUM environment
* Get some experience with project boards and the ticketing system
* Take on a specific role in a team and stick to it
* Communicate with team members
* Be able to take a very broad/vague briefing and turn it into a concrete and viable project
* Learn to work with a specific tech stack (in our case we chose a LAMP back end with an HTML/CSS/Bootstrap front end)

## 3. The group

<!--give credit where it's due and link to group member's github pages-->
| Name | Role                        | Link                                              |
|------|-----------------------------|---------------------------------------------------|
| Barbara | Back-end                    | [gitHub](https://github.com/BarbaraCristinaNunes) |
| Neha | Front-end                   | [gitHub](https://github.com/nehahonrao)           |
| Sven | **Scrum-master** / back-end | [gitHub](https://github.com/Sven-I-Am)            |
| Zain | Back-end / Database admin   | [gitHub](https://github.com/zenimtiazz) |

## 4. Tools and languages used

<!--Adjust the content of this table per exercise
Logos are added on a project basis, I have them stored in a separate folder locally, ready for copying-->

|                   |                                                |                                              |                                                  |
|-------------------|------------------------------------------------|----------------------------------------------|--------------------------------------------------|
| Operating systems | ![windows10](./assets/readme/windows-logo.png) | ![macOS](./assets/readme/macOS-logo.png)     | ![Ubuntu](./assets/readme/ubuntu-logo.png)       |
| Editors           | ![VSCode](./assets/readme/vscode-logo.png)     | ![phpStorm](assets/readme/phpstorm-logo.png) |                                                  |
| DBMS              | ![dataGrip](assets/readme/datagrip-logo.png)   | ![dBeaver](assets/readme/dbeaver-logo.png)   | ![heidisql](assets/readme/heidsql-logo.png)      |
| Front End         | ![html](./assets/readme/html-logo.png)         | ![css](./assets/readme/css-logo.png)         | ![bootstrap](./assets/readme/bootstrap-logo.png) |
| Back End          | ![php](./assets/readme/php-logo.png)           | ![mySQL](./assets/readme/mysql-logo.png)     |
| Server            | ![Linux](./assets/readme/linux-logo.png)       | ![Apache](./assets/readme/apache-logo.png)   |
| Version control   | ![git](./assets/readme/git-logo.png)           | ![github](./assets/readme/github-logo.png)   |

## 5. Timeline

<!-- fill in the timeline with what happened, challenges and how you overcame them, little victories, link to sources if possible -->

- Day 1 (:date: 20/12/2021 <!--dd/mm/yyyy-->)
    - After the project briefing by [coach Tim](https://github.com/Timmeahj) we were divided into groups and sent into our first standup scrum meeting
    - Since we didn't have any more information from the client (Tom = coach Tim in disguise without his coaching knowledge) we started by figuring out what questions to ask the client in the first breifing
    - After our first meeting with the client we knew the following:
        - he would like a platform where user can buy and sell products such as Pokemon cards and collectibles
        - users only require an account when they wish to sell items
        - he has no styling preferences, as long as it works
        - users need to be able to search for products
        - he would like it if there was a price history (graph or other implementation) in the product detail
        - if possible he would like it if buyers could bid on items, but that's not a hard requirement
        - he mentioned ebay as an example
    - With a project briefing this open to interpretation the first day was spent on deciding the structure, roles and tech-stack of the project
    - Sven, as scrum master, created this repository and gave access to all team members
    - We experimented with setting up a MEAN stack project but ran into trouble on the MacOs system
        - After multiple tries to fix the issue and trying to figure out what the MEAN tools entailed, we decided to go back to basics
        - Adding a whole new stack on top of this exercise would cause too much delays and take away from the objective, which is to learn the SCRUM methods
    - After business hours on day 1, Sven re-initiated the project as a LAMP project with an MVC model. All changes were published to gutHub, ready for all members to pull into their local environments on day 2
- Day 2 (:date: 21/12/2021)
    - After getting everyone on the same page we picked the first tickets to work on
    - Neha went to work on the header and footer
    - Zain started building the database
    - Barbara wrote the PDO connection
    - Sven tried to keep everyone up to date and motivated and on track
    - Once the database code was written Sven merged it into development and everyone updated their local files
        - Neha ran into issues running the sql file. She had to install HeidiDB to get the database working on her machine.
    - At the end of day one, the main file structure was built, the database was run on all local machines and we were set to get the backend started on day 3
- Day 3 (:date: 22/12/2021)
    - we didn't get much done on day3, due to the visit of former [coach Koen](https://github.com/grubolsch) who gave an exposition on Symphony, Composer and Doctrine!
    - Zain updated the database to fit the project better
    - Sven renamed the Seller files to User
    - Barbara updated the product model
    - Sven updated the user model
    - Neha finished work on the header and footer (including the styling)
    - Sven merged all stable changes into development
- Day 4 (:23/12/2021)
    - During the stand-up meeting we briefly discussed whether to switch over to a Symphony build, but in the end decided against it. Sven wanted the decision to be unanimous since switching to a new framework is a risk this far into a project.
        - Zain:
            - got started on the user registration functionality
            - had to write a login and registration form for testing purposes
        - Barbara:
            - continued working on the product Model and its getters and setters
            - started work on the productLoader
            - she created a testing mvc model to work with
        - Neha
            - worked on the product grid and cards
            - did some minor fixes to the landing page
            - had to rewrite the css into one style.css
        - Sven added password hashing to the registration
            - kept the index.php up to date
            - merged whatever stable branches got finished
            - fixed all merge issues where needed
            - created new tickets, issues and tried to stay up-to-date with everyone's progress
- Day 5 (:date: 24/12/2021)
    - christmas eve and we're still going!
    - during the stand-up meeting we checked everyone's progress
    - Neha continued work on the product display, getting it ready for back-end deployment
        - she created a method with callback parameters to display productcard in the grid
        - once done with that component she started work on the user dashboard
    - Barbara managed to get the productLoader to write to the database
    - Zain and Sven worked on the form validation for registration and login
    - Zain got the regex working
    - Sven coded a sanitation helper function for use throughout the project
        - it should prevent script-injection
    - Sven again did all the merging and conflict resolution
    - Merry Christmas!
- Day 6 (:date: 27/12/2021)
    - Before the day started, Sven created some more issues to work on, this time trying to be more descriptive
    - During the stand-up we freshened up on the progress and everyone picked their issue to work on
    - After lunch, we had a quick update meeting with the client, who had just answered the questions we email last week
        - We have to make some small changes to the database
        - The front end will have to reflect these as well
    - Neha:
        - continued on the dashboard
        - did the styling for login and registration
    - Barbara:
        - ran into an issue where the code wrote entries into the database multiple times
        - turns out, she was calling the Loader in more than one place
        - finished work on the form validation for the product
    - Zain:
        - Made sure the registration checks for a unique username and email.
            - Sven helped get her started, but once she got how it was done, she worked fast and efficiently
        - Rewrote the database to fit the clients wishes
    - Sven:
        - Fixed whatever issues occurred during and after merges
        - Updated the readme file
        - Kept the tickets up to date
        - Helped when there were questions from the team
        - Made sure the $user object gets saved in a $_SESSION variable once a user logs in
        - Wrote the logout functionality (unset $_SESSION variable)
        - Wrote the go-to dash functionality

## 6. What I learned from this exercise

<!--here you can write anything from a short summary on the subject of the exercise, a readable description of the new skills/knowledge you acquire, to an in depth clarification. As long as it helps you retain what you learned, or easily find the information when working on future projects-->

## 7. To Do

This to do list is for personal use, the full to do list is added at the start of the challenge and as we complete
objectives they will be moved up into the timeline section and ticked off using emotes such as :heavy_check_mark:

<!--For now, this list is usually provided by BeCode and thus quite static. When working on outside projects, this list will become more dynamic as the projects grow and evolve-->

### must-haves

- A Minimal Viable Product based on client briefings:
    - A database or api to store the products and users in :heavy_check_mark:
    - Product overview
        - When product gets added to cart/bought set it to sold to prevent double buys
        - If the buy gets canceled, sold can be reset to false
    - Searchbar
        - with selection of type to limit the query
        - with selection of universe to limit the query
        - query for typed searches
    - Login (mandatory for sellers) :heavy_check_mark:
    - Logout :heavy_check_mark:
    - User dashboard
        - Product overview for logged-in user :heavy_check_mark:
        - Delete account :heavy_check_mark:
          - also auto deletes all remaining products for sale by the user :heavy_check_mark:
        - Change account :heavy_check_mark:
        - Delete product :heavy_check_mark:
        - Change product :heavy_check_mark:
        - Add product :heavy_check_mark:
    - Checkout
        - Buyer has to provide valid email so seller can contact them
        - seller gets email with buyer info to contact

### Nice to have

## 8. Installation Instructions for developers

<!--write clear instructions on how to get your project working on the user's local environment-->

1. clone this repository to your local environment directory
2. git checkout to the development branch
3. follow the instructions in the .env.config file
4. open the index.php on your local apache server
5. Make sure to create a new branch of the development branch before you start working on a new feature/issue/bugfix