# To do

## Exceptions

- [ ] (?) Design exceptions (use static or not)

## Client

- [x] Authorization strategy
- [x] Design `YouTrackClient`
- [ ] (?) `YouTrackClient` should has `Endpoints` entity
- [ ] (?) Ignore `Guzzle` exceptions to cleanup code? What if guzzle will be initialized with exceptions flag?
- [x] Move `authenticate()` method out from the constructor. It should be called before each request, but prevent authentication call recursion.
- [x] Remove `authenticate()` method from the Authorizer contract? 

## Testing

- [x] Snapshot\Mock\Stub\Fake testing for API calls

## Continuous Integration

- [x] Automate unit tests
- [ ] Coverage analysis
- [x] Code mess detector
- [x] Code style checker
