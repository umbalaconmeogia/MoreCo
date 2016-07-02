package moreco.eas.evolable.asia.moreco.util;

import android.app.Activity;
import android.view.View;
import android.view.inputmethod.InputMethodManager;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class EditTextUtils {

    public static void hideSoftKeyboard(Activity activity,View view) {
        InputMethodManager inputMethodManager = (InputMethodManager)  activity.getSystemService(Activity.INPUT_METHOD_SERVICE);
        inputMethodManager.hideSoftInputFromWindow(view.getWindowToken(), 0);
    }


}
