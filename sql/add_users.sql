Set @pwd = (select password_hash from user where id=1);
insert into user(id, username, password_hash)VALUES
  (3, 'userA', @pwd),
  (4, 'userB', @pwd),
  (5, 'userC', @pwd);