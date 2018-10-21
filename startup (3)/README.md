# Login_1DV608
Interface repository for 1DV608 assignment 2 and 4


| Use case       | 1                                              |
|----------------|------------------------------------------------|
| Reference ID   | 1                                              |
| Primary Actor  | User                                           |
| Description    | User wants to play hang man.                   |
| Pre-condition  | server up and running. User must be logged in. |
| Post-condition | User can successfully play hang man.           |
| Main scenario  | User has logged in and wants to play hang man. |
| 1              | User clicks on button "Start Game"             |
| 2              | sytem render the game view.                                             |



| Use case       | 2                                              |
|----------------|------------------------------------------------|
| Reference ID   | 2                                              |
| Primary Actor  | User                                           |
| Description    | User wants to guess letter.                    |
| Pre-condition  | server up and running. User must be logged in. |
| Post-condition | User has successfully posted a letter.         |
| Main scenario  | user provides a guess.                         |
| 1              | User clicks on any letter.                     |
| 2              | System prints out result. and disables the clicked button|



| Use case       | 2                                                      |
|----------------|--------------------------------------------------------|
| Reference ID   | 2.1                                                    |
| Primary Actor  | User                                                   |
| Description    | User wants to guess, and the guess is not in the word. |
| Pre-condition  | server up and running. User must be logged in.         |
| Post-condition | system will print out that the guess was wrong         |
| Main scenario  | user provides a guess that is not contained in the word|
| 1              | user provides a letter that is not in the word.        |
| 2              | System prints out that the guess was wrong.            |


| Use case       | 2                                                                   |
|----------------|---------------------------------------------------------------------|
| Reference ID   | 2.2                                                                 |
| Primary Actor  | User                                                                |
| Description    | User wants to guess, and the guess on a letter that is in the word. |
| Pre-condition  | server up and running. User must be logged in.                      |
| Post-condition | system prints out that the guess was correct.                       |
| Main scenario  | user provides a correct guess.                                      |
| 1              | user provides a letter that is in the word                          |
| 2              | System prints out the guessed word on the screen.                   |


| Use case       | 3                                                                      |
|----------------|------------------------------------------------------------------------|
| Reference ID   | 3                                                                      |
| Primary Actor  | User                                                                   |
| Description    | User is in a active game and wants to quit the game.              |
| Pre-condition  | server up and running. User must be logged in and have a current game. |
| Post-condition | The user shall be rendered to the logged in page.                      |
| Main scenario  | user wants to quit the game.                                           |
| 1              | User navigates to the button "Quit game".                              |
| 2              | system renders the user to the logged in page.                         |



| Use case           | 4                                                                                           |
|--------------------|---------------------------------------------------------------------------------------------|
| Reference ID       | 4                                                                                           |
| Primary Actor      | User                                                                                        |
| Description        | User finish game.                                                                           |
| Pre-condition      | server up and running. User must be logged in and have a current game.                      |
| Post-condition     | system shall remove buttons and display either "Game Over"or You Guessed the correct word!. |
| Main scenario      | User finish the game.                                                                       |
| 1                  | User guesses the correct word                                                               |
| 2                  | system will remove all buttons and display "You Guessed the correct word!".                 |
| Secondary scenario | User gets game over.                                                                        |
| 1                  | user guesses the wrong word.                                                                |
| 2                  | system will remove all buttons and display "Game Over".                                     |

