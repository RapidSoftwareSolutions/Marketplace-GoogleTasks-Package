[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleTasks/functions?utm_source=RapidAPIGitHub_GoogleTasksFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# GoogleTasks Package
Google Tasks is a free online service that helps manage your to-do lists. You can access Google Tasks via your Google account.
* Domain: [www.google.com](https://mail.google.com/tasks/canvas)
* Credentials: clientId, clientSecret

## How to get credentials: 
1. When you create your application, you register it using the [Google API Console](https://console.developers.google.com/). Google then provides information you'll need later, such as a client ID and a client secret.
2. Activate the Google Tasks API in the Google API Console. (If the API isn't listed in the API Console, then skip this step)
3. When your application needs access to user data, it asks Google for a particular scope of access.
4. Google displays a consent screen to the user, asking them to authorize your application to request some of their data.
5. If the user approves, then Google gives your application a short-lived access token.
 
## GoogleTasks.getAccessToken
Get AccessToken.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Client ID
| clientSecret| credentials| Client secret
| code        | String     | Code you received from Google after the user granted access
| redirectUri | String     | The same redirect URL as in received Code step.

## GoogleTasks.refreshToken
Get new accessToken by refreshToken.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Client ID
| clientSecret| credentials| Client secret
| refreshToken| String     | A token that you can use to obtain a new access token. Refresh tokens are valid until the user revokes access. Again, this field is only present in this response if you set the access_type parameter to offline in the initial request to Google's authorization server.

## GoogleTasks.revokeAccessToken
In some cases a user may wish to revoke access given to an application. A user can revoke access by visiting Account Settings. It is also possible for an application to programmatically revoke the access given to it. Programmatic revocation is important in instances where a user unsubscribes or removes an application. In other words, part of the removal process can include an API request to ensure the permissions granted to the application are removed.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| The token can be an access token or a refresh token. If the token is an access token and it has a corresponding refresh token, the refresh token will also be revoked.

## GoogleTasks.getAllTaskLists
Returns all the authenticated user's task lists.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| maxResults | Number| Maximum number of task lists returned on one page. Optional. The default is 100.
| pageToken  | String| Token specifying the result page to return. Optional.
| fields     | List  | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.getTaskList
Returns the authenticated user's specified task list.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklist   | String| Task list identifier.
| fields     | List  | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.createTaskList
Creates a new task list and adds it to the authenticated user's task lists.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| updated    | DatePicker| Last modification time of the task list (as a RFC 3339 timestamp).
| selfLink   | String    | URL pointing to this task list. Used to retrieve, update, or delete this task list.
| title      | String    | Title of the task list.
| etag       | String    | ETag of the resource.
| id         | String    | Task list identifier.
| kind       | Select    | Type of the resource.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.updateTaskList
Updates the authenticated user's specified task list.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| updated    | DatePicker| Last modification time of the task list (as a RFC 3339 timestamp).
| selfLink   | String    | URL pointing to this task list. Used to retrieve, update, or delete this task list.
| title      | String    | Title of the task list.
| etag       | String    | ETag of the resource.
| id         | String    | Task list identifier.
| kind       | Select    | Type of the resource.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.deleteTaskList
Deletes the authenticated user's specified task list.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklist   | String| Task list identifier.

## GoogleTasks.patchTaskList
Updates the authenticated user's specified task list. This method supports patch semantics.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| updated    | DatePicker| Last modification time of the task list (as a RFC 3339 timestamp).
| selfLink   | String    | URL pointing to this task list. Used to retrieve, update, or delete this task list.
| title      | String    | Title of the task list.
| etag       | String    | ETag of the resource.
| id         | String    | Task list identifier.
| kind       | Select    | Type of the resource.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.getAllTasks
Returns all tasks in the specified task list.

| Field        | Type      | Description
|--------------|-----------|----------
| accessToken  | String    | Access Token. Use getAccessToken to get it.
| tasklist     | String    | Task list identifier.
| updatedMin   | DatePicker| Lower bound for a task's last modification time (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by last modification time.
| showHidden   | Select    | Flag indicating whether hidden tasks are returned in the result. Optional. The default is False.
| showDeleted  | Select    | Flag indicating whether deleted tasks are returned in the result. Optional. The default is False.
| showCompleted| Select    | Flag indicating whether completed tasks are returned in the result. Optional. The default is True.
| pageToken    | String    | Token specifying the result page to return. Optional.
| maxResults   | Number    | Maximum number of task lists returned on one page. Optional. The default is 100.
| dueMin       | DatePicker| Lower bound for a task's due date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by due date.
| dueMax       | DatePicker| Upper bound for a task's due date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by due date.
| completedMax | DatePicker| Upper bound for a task's completion date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by completion date.
| completedMin | DatePicker| Lower bound for a task's completion date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by completion date.
| fields       | List      | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.getTask
Returns the specified task.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklistId | String| Task list identifier.
| taskId     | String| Task list identifier.
| fields     | List  | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.createTask
Creates a new task on the specified task list.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| links      | Array     | Collection of links. This collection is read-only.
| hidden     | Select    | Flag indicating whether the task is hidden. This is the case if the task had been marked completed when the task list was last cleared. The default is False. This field is read-only.
| completed  | Select    | Flag indicating whether the task has been deleted. The default if False.
| completed  | DatePicker| Completion date of the task (as a RFC 3339 timestamp). This field is omitted if the task has not been completed.
| due        | DatePicker| Due date of the task (as a RFC 3339 timestamp). Optional.
| status     | Select    | Status of the task. This is either `needsAction` or `completed`.
| notes      | String    | Notes describing the task. Optional.
| tasklistId | String    | Task list identifier.
| position   | String    | String indicating the position of the task among its sibling tasks under the same parent task or at the top level. If this string is greater than another task's corresponding position string according to lexicographical ordering, the task is positioned after the other task under the same parent task (or at the top level). This field is read-only. Use the `move` method to move the task to another position.
| parent     | String    | Parent task identifier. This field is omitted if it is a top-level task. This field is read-only. Use the `move` method to move the task under a different parent or to the top level.
| selfLink   | String    | URL pointing to this task. Used to retrieve, update, or delete this task.
| updated    | DatePicker| Last modification time of the task (as a RFC 3339 timestamp).
| title      | String    | Title of the task.
| etag       | String    | ETag of the resource.
| id         | String    | Task identifier.
| kind       | Select    | Type of the resource.
| parent     | String    | Parent task identifier. If the task is created at the top level, this parameter is omitted. Optional.
| previous   | String    | Previous sibling task identifier. If the task is created at the first position among its siblings, this parameter is omitted. Optional.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id.

## GoogleTasks.updateTask
Creates a new task on the specified task list.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| links      | Array     | Collection of links. This collection is read-only.
| hidden     | Select    | Flag indicating whether the task is hidden. This is the case if the task had been marked completed when the task list was last cleared. The default is False. This field is read-only.
| completed  | Select    | Flag indicating whether the task has been deleted. The default if False.
| completed  | DatePicker| Completion date of the task (as a RFC 3339 timestamp). This field is omitted if the task has not been completed.
| due        | DatePicker| Due date of the task (as a RFC 3339 timestamp). Optional.
| status     | Select    | Status of the task. This is either `needsAction` or `completed`.
| notes      | String    | Notes describing the task. Optional.
| tasklistId | String    | Task list identifier.
| position   | String    | String indicating the position of the task among its sibling tasks under the same parent task or at the top level. If this string is greater than another task's corresponding position string according to lexicographical ordering, the task is positioned after the other task under the same parent task (or at the top level). This field is read-only. Use the `move` method to move the task to another position.
| parent     | String    | Parent task identifier. This field is omitted if it is a top-level task. This field is read-only. Use the `move` method to move the task under a different parent or to the top level.
| selfLink   | String    | URL pointing to this task. Used to retrieve, update, or delete this task.
| updated    | DatePicker| Last modification time of the task (as a RFC 3339 timestamp).
| title      | String    | Title of the task.
| etag       | String    | ETag of the resource.
| id         | String    | Task identifier.
| kind       | Select    | Type of the resource.
| parent     | String    | Parent task identifier. If the task is created at the top level, this parameter is omitted. Optional.
| previous   | String    | Previous sibling task identifier. If the task is created at the first position among its siblings, this parameter is omitted. Optional.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id.

## GoogleTasks.deleteTask
Deletes the specified task from the task list.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklistId | String| Task list identifier.
| taskId     | String| Task list identifier.

## GoogleTasks.clearTaskList
Deletes the specified task from the task list.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklistId | String| Task list identifier.

## GoogleTasks.moveTask
Moves the specified task to another position in the task list. This can include putting it as a child task under a new parent and/or move it to a different position among its sibling tasks.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token. Use getAccessToken to get it.
| tasklistId | String| Task list identifier.
| taskId     | String| Task identifier.
| parent     | String| New parent task identifier. If the task is moved to the top level, this parameter is omitted. Optional.
| previous   | String| New previous sibling task identifier. If the task is moved to the first position among its siblings, this parameter is omitted. Optional.
| fields     | List  | List of fields.To display all fields, use `*`. Examples: id

## GoogleTasks.patchTask
Updates the specified task. This method supports patch semantics.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token. Use getAccessToken to get it.
| links      | Array     | Collection of links. This collection is read-only.
| hidden     | Select    | Flag indicating whether the task is hidden. This is the case if the task had been marked completed when the task list was last cleared. The default is False. This field is read-only.
| completed  | Select    | Flag indicating whether the task has been deleted. The default if False.
| completed  | DatePicker| Completion date of the task (as a RFC 3339 timestamp). This field is omitted if the task has not been completed.
| due        | DatePicker| Due date of the task (as a RFC 3339 timestamp). Optional.
| status     | Select    | Status of the task. This is either `needsAction` or `completed`.
| notes      | String    | Notes describing the task. Optional.
| tasklistId | String    | Task list identifier.
| position   | String    | String indicating the position of the task among its sibling tasks under the same parent task or at the top level. If this string is greater than another task's corresponding position string according to lexicographical ordering, the task is positioned after the other task under the same parent task (or at the top level). This field is read-only. Use the `move` method to move the task to another position.
| parent     | String    | Parent task identifier. This field is omitted if it is a top-level task. This field is read-only. Use the `move` method to move the task under a different parent or to the top level.
| selfLink   | String    | URL pointing to this task. Used to retrieve, update, or delete this task.
| updated    | DatePicker| Last modification time of the task (as a RFC 3339 timestamp).
| title      | String    | Title of the task.
| etag       | String    | ETag of the resource.
| id         | String    | Task identifier.
| kind       | Select    | Type of the resource.
| parent     | String    | Parent task identifier. If the task is created at the top level, this parameter is omitted. Optional.
| previous   | String    | Previous sibling task identifier. If the task is created at the first position among its siblings, this parameter is omitted. Optional.
| fields     | List      | List of fields.To display all fields, use `*`. Examples: id.

