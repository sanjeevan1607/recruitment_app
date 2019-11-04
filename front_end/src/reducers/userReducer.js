export default (state = {}, action) => {
  // Payload from api call
  let payload = action.payload;

  /**
   * User payload to local storage
   *
   * @param {Object} payload
   */
  function payloadToLocalStorage(payload) {
    localStorage.setItem("access_token", payload.data.access_token);
    localStorage.setItem("uID", payload.data.uID);
  }

  switch (action.type) {
    case "USER_LOGIN":
      if (payload.data.access_token && payload.data.uID) {
        payloadToLocalStorage(payload);
        payload = payload.data;
      }

      return {
        ...state,
        user: payload
      };

    case "USER_REGISTER":
      if (payload.data.access_token && payload.data.uID) {
        payloadToLocalStorage(payload);

        payload = payload.data;
      }

      return {
        ...state,
        user: payload
      };

    default:
      return state;
  }
};
