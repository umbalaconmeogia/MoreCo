package moreco.eas.evolable.asia.moreco.database;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */

public class MoreCoDB {
    public MoreCoDB() {
    }

    private static MoreCoDB ourinstance = new MoreCoDB();

    public static MoreCoDB getOurinstance() {
        return ourinstance;
    }
}
